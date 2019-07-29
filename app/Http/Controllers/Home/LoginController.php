<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class LoginController extends Controller
{
    //退出登陆
    public function outLogin()
    {
        session(['home_login'=>false]);
        session(['home_user'=>null]);

        return redirect('home/login');
    }
    //显视登录页面
    public function login()
    {
    	return view('home.login.login');
    }

    //执行登陆
    public function doLogin(Request $request)
    {
    	$uname = $request->input('uname');
    	$upass = $request->input('upass');
    	$data = DB::table('admin_users')->where('uname',$uname)->first();
    	//dd($data,$upass,$uname);
    	if(!$data){
    		echo "<script>alert('用户名或密码错误');location.href='/home/login';</script>";
    		exit;
    	}

    	if(!Hash::check($upass,$data->upass)){
    		echo "<script>alert('用户名或密码错误11');location.href='/home/login';</script>";
    		exit;
    	}
    	//dd($data);
    	//执行登录
    	session(['admin_login'=>true]);
    	session(['home_user'=>$data]);
    	
    	//dd(session('home_user'));
    	return redirect('/home/index');
    }

}
