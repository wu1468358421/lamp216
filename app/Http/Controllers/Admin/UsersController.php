<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsers;
use App\Models\Users;
use App\Models\UsersInfo;
use Illuminate\Support\Facades\Storage;
use Hash;
use DB;

class UsersController extends Controller
{

    // public function data()
    // {
    //     for($i = 0 ; $i < 30; $i++){
    //         $data = [
    //         'uname'=>'zhangsan'.rand(1234,4321),
    //         'upass'=>Hash::make('123123'),
    //         'email'=>'zhangsan'.rand(1234,4321).'qq.com',
    //         'phone'=>'1'.rand(1234,4321).rand(123456,654321),
    //         ];
    //         $file_path = '/uploads/20190620/CBciWocSMtnjGmgfZRWdZb3SFjy9folt2hsHloux.jpeg';

    //         $user = new Users;
    //         $user->uname = $data['uname'];
    //         $user->upass = Hash::make($data['upass']);
    //         $user->email = $data['email']; 
    //         $user->phone = $data['phone'];
    //         $res1 = $user->save();
    //         $uid = $user->id;

    //         // // //压入头像
    //         $userinfo = new UsersInfo;
    //         $userinfo->uid = $uid;
    //         $userinfo->profile = $file_path;
    //         $res2 = $userinfo->save();
    //     }
        
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->data();
        //接收搜索的参数
        //dd(route('bb'));
        $search_uname = $request->input('search_uname','');
        $search_email = $request->input('search_email','');
      

        $users = Users::where('uname','like','%'.$search_uname.'%')->where('email','like','%'.$search_email.'%')->paginate(5);
        return view('admin.users.index',['users'=>$users,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //用户添加
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsers $request)
    {
        //
        //dump($request->all());
       
        DB::beginTransaction();
        
        // 上传头像
        if($request->hasFile('profile')){
            // 创建文件上传对象
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = '';
        }

        //dump($file_path);

        $data = $request->all();
        //接受数据
        $user = new Users;
        $user->uname = $data['uname'];
        $user->upass = Hash::make($data['upass']);
        $user->email = $data['email']; 
        $user->phone = $data['phone'];
        //dd($user);
        $res1 = $user->save();
        if($res1){
            //获取uid
            $uid = $user->id;
        }
        
       //DB::table()->insertGetId();//返回最后插入id号

        // // //压入头像
        $userinfo = new UsersInfo;
        $userinfo->uid = $uid;
        $userinfo->profile = $file_path;
        $res2 = $userinfo->save();

        if($res1 && $res2){
            DB::commit();
            return redirect('admin/users')->with('success','添加成功');
        }else{
            DB::rollBack();
            return back()->with('error','添加失败');
        }
    }

    /**
     * 】
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改
        $user = Users::find($id);

        //dump($user);
        return view('admin.users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         DB::beginTransaction();
        //获取头像
        if($request->hasFile('profile')){
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = $request->input('old_profile');
        }

        $user = Users::find($id);
        $user->email = $request->input('email','');
        $user->phone = $request->input('phone','');

        $res1 = $user->save();
        $userinfo = UsersInfo::where('uid',$id)->first();
        $userinfo->profile = $file_path;
        $res2 = $userinfo->save();

         if($res1 && $res2){
            DB::commit();
            return redirect('admin/users')->with('success','修改成功');
        }else{
            DB::rollBack();
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //事务回滚
        DB::beginTransaction();

        $res1 = Users::destroy($id);
        $res2 = UsersInfo::where('uid',$id)->delete();

        //删除头像
        //use Illuminate\Support\Facades\Storage;

        //Storage::delete('file.jpg');
        //Storage::delete(['file1.jpg', 'file2.jpg']);

        if($res1 && $res2){
            DB::commit();
            return redirect('admin/users')->with('success','删除成功');
        }else{
            DB::rollBack();
            return back()->with('error','删除失败');
        }
    }
}
