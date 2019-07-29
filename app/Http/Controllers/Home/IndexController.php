<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;

class IndexController extends BaseController
{
    public static function getPidCatesData($pid = 0)
    {
        //获取一级分类
        $data = Cates::where('pid',$pid)->get();
        foreach($data as $k=>$v){
            //$erji = Cates::where('pid',$v->id)->get();
            $v->sub = self::getPidCatesData($v->id);
        }
        //获取商品
        
        // //获取pid为0的顶级分类
        // $pids = DB::table('cates')->where('pid','0')->get();
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topCate = Cates::where('id', 19)->first();
        $list = $topCate->goods_from_top;
        // dd($list);
        $cates_data = self::getPidCatesData(0);

        // foreach ($cates_data as $key => $value) {
        //     dump($value->goods_from_top);
        // }
        // dd(11);
        // dump($aa->id);
        // dump($aa);
        $pids = DB::table('cates')->where('pid','0')->get();
        // dump($pids);
        // return view('home.index.index',['cates_data'=>$cates_data]);
        return view('home.index.index',['pids'=>$pids]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
