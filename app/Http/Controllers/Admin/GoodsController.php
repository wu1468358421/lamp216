<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收搜索的参数
        $search_title = $request->input('search_title','');

        $goods_data = DB::table('goods')->where('title','like','%'.$search_title.'%')->paginate(10);
        // $goods = DB::table('goods')->get();
        // // dump($goods);
        // // $goodss = [];
        // foreach($goods as $k=>$v)
        // {
            
        //     unset($v->id);
        //     $goods += $v;
        //     // dump($v);
        //     // $goodss += $v;
        //     // dump($goodss);
        // }
        
        // // $cc = DB::table('goods')->insert($goods);
        // dd($goods);
        //显视
        return view('admin.goods.index',['goods_data'=>$goods_data,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //添加商品
    public function create()
    {
        $cates = DB::table('cates')->get();
        dump($cates);
        return view('admin.goods.create',['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $cid = $request->input('pid');
        $cid = array_filter($cid);
        $k = array_search(max($cid),$cid);

        $data['cid']=$cid[$k];
      
        //文件上传
        if($request->hasFile('img')){
            $path = $request->file('img')->store(date('Ymd'));
        }else{
            $path = '';
        }
        //随机数
        $a = range(0,9);
        for($i=0;$i<10;$i++){
            $b[] = array_rand($a);

        }
        $n = join("",$b);
        // dump($path);
        $data['gimg'] = $request->input('gimg','');
        $data['title'] = $request->input('title','');
        $data['price'] = $request->input('price','');
        $data['num'] = $request->input('num','');
        $data['desc'] = $request->input('desc','');
        $data['img'] = $path;
        
        $data['pro_no'] =time().$n;
        $data['add_time'] = time();

        
        // dd($data);
        $res = DB::table('goods')->insert($data);


        if($res){
            return redirect('admin/goods')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //修改
    public function edit($id)
    {
        $data = DB::table('goods')->where('id',$id)->first();
        dump($data);
        return view('admin.goods.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //更新
    public function update(Request $request, $id)
    {
        //dump($request->all());
         //文件上传
        if($request->hasFile('img')){
            $path = $request->file('img')->store(date('Ymd'));
        }else{
            $path = '';
        }
        
        // dump($path);
        $data['title'] = $request->input('title','');
        $data['price'] = $request->input('price','');
        $data['num'] = $request->input('num','');
        $data['desc'] = $request->input('desc','');
        $data['img'] = $path;
        $data['add_time'] = time();
        // dd($data);
        $res = DB::table('goods')->where('id',$id)->update($data);


        if($res){
            return redirect('admin/goods')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
        //dump($data);
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
       $res = DB::table('goods')->where('id',$id)->delete();
        if($res){
            return redirect('admin/goods')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    //添加的分类
    public function getCate(Request $request)
    {
        // echo '1111';
        // dump($request->input('id'));
        $id=$request->id;
        $catelevel = DB::table('cates')->where('pid',$id)->get();

        // return json_encode($catelevel);
        return $catelevel;
    }
}
