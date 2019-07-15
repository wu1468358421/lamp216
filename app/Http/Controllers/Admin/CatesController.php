<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;
use Illuminate\Http\Request;

class CatesController extends Controller
{
    public static function getCateData()
    {
        $cates = Cates::select('*', DB::raw("concat(path,',',id) as paths"))->orderBy('paths', 'asc')->get();
        // $cates = Cates::all();
        foreach ($cates as $k => $v) {
            $n                = substr_count($v->path, ',');
            $cates[$k]->cname = str_repeat('|-----', $n) . $v->cname;
        }

        return $cates;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        //显示模板
        return view('admin.cates.index', ['cates' => self::getCateData()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id', 0);
        //$cates = Cates::all();
        //显示模板
        return view('admin.cates.create', ['id' => $id, 'cates' => self::getCateData()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取pid
        $pid = $request->input('pid', 0);

        if ($pid == 0) {
            $path = 0;
        } else {
            //pid = 3
            //获取父级数据
            $parent_data = Cates::find($pid);
            $path        = $parent_data->path . ',' . $parent_data->id;
        }

        //将数据压入到数据库
        $cate        = new Cates;
        $cate->cname = $request->input('cname', '');
        $cate->pid   = $pid;
        $cate->path  = $path;

        $res1 = $cate->save();

        if ($res1) {
            return redirect('admin/cates')->with('success', '添加成功');
        } else {
            return back()->with('error', '添加失败');
        }
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
