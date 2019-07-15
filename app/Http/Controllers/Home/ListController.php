<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\Home\CarController;

class ListController extends BaseController
{
	public function __construct()
	{
		// 引入类文件
		require __ROOT__ .'/pscws4/pscws4.class.php';
		// 实例化
		@$this->cws = new \PSCWS4;
		//设置字符集
		$this->cws->set_charset('utf8');
		//设置词典
		$this->cws->set_dict('pscws4/etc/dict.utf8.xdb');
		//设置utf8规则
		$this->cws->set_rule('pscws4/etc/rules.utf8.ini');
		//忽略标点符号
		$this->cws->set_ignore(true);
	}

	public function dataWord()
	{
		$data = DB::table('goods')->select('title','id')->get();
		//dump($data);
		foreach ($data as $key => $value) {
			$arr = $this->word($value->title);
			foreach($arr as $kk=>$vv){
				DB::table('goods_word')->insert(['gid'=>$value->id,'word'=>$vv]);
			}
			
		}
	}
    //
    public function index(Request $request)
    {
    	$this->dataWord();
    	$countCar = CarController::countCar();
    	// 接收  搜索参数
    	$search = $request->input('search','');

    	// $data = DB::table('goods')->where('title','like','%'.$search.'%')->get();

    	/* 中文分词 开始  */

    	if(!empty($search)){
    		if(preg_match('/[\w]/',$search)){
    			//echo "this is mysql like ....";
    			// dump(preg_match('/[\w]/',$search));
    			$data2 = DB::table('goods')->where('title','like','%'.$search.'%')->get();
    		}else{
    			//echo "this is 中文分词 ....";
	    		$gid = DB::table('view_goods_word')->select('gid')->where('word',$search)->get();
		    	// dump($gid);
		    	$gids = [];
		    	foreach ($gid as $key => $value) {
		    		$gids[] = $value->gid;
		    	}
		    	// dump($gids);
		    	// dump($data2);
		    	$data2 = DB::table('goods')->whereIn('id',$gids)->get();
	    	}
    	}else{
    		$data2 = DB::table('goods')->get();
    	}

    	/* 中文分词 结束  */

    	return view('home.list.index',['data'=>$data2,'countCar'=>$countCar]);
    }

    public function word($text)
    {
    	$arr = explode(' ',$text);
		$preg = '/[\w\+\%\.\(\)]+/';

		$string = ''; 
		foreach ($arr as $key => $value) {
			// if(!preg_match($preg,$value)){
			// 	$string .= $value;
			// }

			$string .= preg_replace($preg,'',$value);

		}

		//传递字符串
		$this->cws->send_text($string);
		//获取权重最高的前十个词
		// $res = $cws->get_tops(10);// top 顶部
		//获取所有的结果
		$res = $this->cws->get_result();
		//dd($res);
		$list  = [];
		foreach ($res as $key => $value) {
			$list[] = $value['word'];
		}
		// var_dump($list);
		return $list;
	}

	public function __destruct()
	{
		//关闭
		$this->cws->close();
	}
}
