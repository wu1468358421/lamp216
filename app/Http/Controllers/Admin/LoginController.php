<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class LoginController extends Controller
{
    public function outlogin()
    {
        session(['admin_login'=>false]);
        session(['admin_user'=>null]);

        return redirect('admin/login');
    }

    //显视登录页
    public function login()
    {
    	return view('admin.login.login');
    }

    //执行登录
    public function dologin(Request $request)
    {
    	//dump($request->all());
    	$uname = $request->input('uname','');
    	$upass = $request->input('upass','');

    	$admin_user_data = DB::table('admin_users')->where('uname',$uname)->first();
    	if(!$admin_user_data){
    		echo "<script>alert('用户名或密码错误');location.href='/admin/login';</script>";
    		exit;
    	}

    	if (!Hash::check($upass, $admin_user_data->upass)) {
    		echo "<script>alert('用户名或密码错误111111');location.href='/admin/login';</script>";
    		exit;
		}
    	//dump($admin_user_data);
    	//执行登录
    	session(['admin_login'=>true]);
    	session(['admin_user'=>$admin_user_data]);

        //获取当前用户的权限
        $admin_user_nodes = DB::select('select n.aname,n.cname from nodes as n,roles_nodes as rn,adminusers_roles as ur where ur.uid = '.$admin_user_data->id.' and ur.rid = rn.rid and rn.nid = n.id');
        $temp = [];
        foreach($admin_user_nodes as $k=>$v){
            $temp[$v->cname][] = $v->aname;
            if($v->aname == 'create'){
                $temp[$v->cname][] = 'store';
            }

            if($v->aname == 'edit'){
                $temp[$v->cname][] = 'update';
            }

            if($v->aname == 'index'){
                $temp[$v->cname][] = 'show';
            }
        }
        // dump($temp);
        // dd( $admin_user_nodes );
        session(['admin_user_nodes'=>$temp]);

    	//跳转
    	return redirect('admin');
    }
}
