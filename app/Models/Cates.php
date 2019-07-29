<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cates extends Model
{
    //设置表名
    public $table = 'cates';

    //配置一对一关系
    public function goods(){
    	return $this->hasOne('App\Models\Goods', 'id', 'cid');
    }


    public function getGoodsFromTopAttribute(){
    	$list = $this->findAllChilds($this->id);
    	$cids = array_column($list, 'id');
    	//打印sql语句
    	// DB::connection()->enableQueryLog();

    	Goods::where('cid', $cids)->get();

  		// dd(DB::getQueryLog());
  		
    	return Goods::whereIn('cid', $cids)->get();
    	
    }


    public function findAllChilds($id, $list = array()){
    	if(is_array($id)){
			$_list = $this->whereIn('pid', $id)->get()->toArray();
    	}else{
    		$_list = $this->where('pid', $id)->get()->toArray();
    	}
    	
    	if ($_list) {
    		$ids = array_column($_list, 'id');
    		$list = array_merge($_list, $list);
    		return $list = $this->findAllChilds($ids, $list);
    	} else {
    		return $list;
    	}
    }

    public function getParentAttribute(){
    	$parent = $this->where('id', $this->pid)->first();
    	return $parent;
    }
}
