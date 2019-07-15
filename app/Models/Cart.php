<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //设置表名
    public $table = 'cart';


    public function goods(){
    	return $this->hasOne('App\Models\Goods', 'id', 'gid');
    }
}
