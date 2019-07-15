<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ColumnController extends Controller
{
    //
    public function index()
    {
    	$data = DB::table('column')->get();
    	dump($data);
    	return view('admin.column.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.column.create');
    }

    //存入数据库
    public function store(Request $request)
    {
    	// echo 'dd';
    	// dump($request->input('uname',''));
    	$cname = $request->input('cname','');
    	$res = DB::table('column')->insert(['cname'=>$cname]);
    	if($res){
            return redirect('admin/column')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }

    }

    //修改栏目名称
    public function edit($id)
    {
       
    	return view('admin.column.edit',['id'=>$id]);
    }

    //提交到数据库
    public function update(Request $request,$id)
    {
        $cname = $request->input('cname','');
        $res = DB::table('column')->where('id',$id)->update(['cname'=>$cname]);
        if($res){
            return redirect('admin/column')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    //删除
    public function destroy($id)
    {
        $res = DB::table('column')->where('id',$id)->delete();
        if($res){
            return redirect('admin/column')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
