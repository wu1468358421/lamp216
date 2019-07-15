<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CarController;

class OrderController extends BaseController
{
    //结算页面
    public function account()
    {
    	if(!empty($_SESSION['car'])){
			$data = $_SESSION['car'];
		}else{
			$data = [];
		}

		//总价格
		$priceCount = CarController::priceCount();
		
    	return view('home.order.account',['data'=>$data,'priceCount'=>$priceCount]);
    }

    //支付
    public function pay(Request $request)
    {
    	//检查登录
    	// if(!session('home_login')){
    	// 	alert('登录页面');
    	// }
    	
    	//检查地址
    	
    	//支付成功
    	
    	//将数据压入订单表 订单表 详情表
    }
}
