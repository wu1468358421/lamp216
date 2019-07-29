<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收搜索的参数
        $bname = $request->input('bname','');

        $data = DB::table('brand')->where('bname','like','%'.$bname.'%')->paginate(10);
        return view('admin.brand.index',['data'=>$data,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //文件上传
        if($request->hasFile('img')){
            $path = $request->file('img')->store(date('Ymd'));
        }else{
            $path = '';
        }
        
        //echo "werwrwq";

        $data['bname'] = $request->input('bname','');
        
        $data['desc'] = $request->input('desc','');

        $data['img'] = $path;
       
        
        // dump($request->all(),$data);
        // dd($data);
        $res = DB::table('brand')->insert($data);

        if(empty($res)){
            echo json_encode(['msg'=>'err','info'=>'添加失败']);
            exit;
        }

        if($res){
            echo json_encode(['msg'=>'success','info'=>'添加成功']);
            exit;
        }

        // if($res){
        //     return redirect('admin/goods')->with('success','添加成功');
        // }else{
        //     return back()->with('error','添加失败');
        // }
        // dump($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('brand')->where('id',$id)->first();
        // dump($data);
        return view('admin.brand.edit',['data'=>$data]);
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
        // dd($request->all());
        //文件上传
        // if($request->hasFile('img')){
        //     $path = $request->file('img')->store(date('Ymd'));
        // }else{
        //     $path = '';
        // }
        // echo "12313";
        $data['bname'] = $request->input('bname','');
        $data['desc'] = $request->input('desc','');
        // $data['img'] = $path;
        $id = $request->input('id','');

        // dd(11);
        // dump($data);
        $res = DB::table('brand')->where('id',$id)->update($data);
        // return \Response::json($data);
        
        if(empty($res)){
            echo json_encode(['msg'=>'err','info'=>'修改失败']);
            exit;
        }

        if($res){
            echo json_encode(['msg'=>'success','info'=>'修改成功']);
            exit;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //删除
    public function destroy($id)
    {
        // dump($id);
        $res = DB::table('brand')->where('id',$id)->delete();

        if(empty($res)){
            echo json_encode(['msg'=>'err','info'=>'删除失败']);
            exit;
        }

        if($res){
            echo json_encode(['msg'=>'success','info'=>'删除成功']);
            exit;
        }
    }
}
