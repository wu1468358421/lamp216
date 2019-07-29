<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Models\Cart;

use DB;

class CarController extends BaseController
{
	//购物车列表页面
	public function index()
	{

       //dd($data);
        if(session('home_user')){
            //dd(session('home_user')->id);
            $uid = session('home_user')->id;

            $data = Cart::where('uid',$uid)->get();
        }else{
            if(!empty($_SESSION['car'])){
                $data = $_SESSION['car'];
            }else{
                $data = [];
            }
        }
		

        //dump($data);
		//总价格
		$priceCount = self::priceCount();

		return view('home.car.index',['data'=>$data,'priceCount'=>$priceCount]);
	}
    //加入购物车
    public function add(Request $request)
    {
    	// $_SESSION['car'] = null;
    	// exit;
    	// echo 'dd';
        //商品id
    	$id = $request->input('id',0);

        
        //在登录情况下
        if(session('home_user')){
            $uid = session('home_user')->id;
            //查找登录用户的购物车信息
            $cart = DB::table('cart')->where('uid',$uid)->get();
            //获取登录用户的商品gid
            $cart_num = [];
            foreach($cart as $k=>$v){
               //dump($v->gid);
               $cart_num[] = $v->gid;
               //
            }

            $cart['gid'] = $id;
            $cart['uid'] = session('home_user')->id;
            $cart['num'] = 1;
            $cart['created_at'] = time();
            //dump($cart);
            //判断当前用户的购物车是否有同样的商品
            if(in_array($id,$cart_num)){

                //在 字段 num +1
                $num = DB::table('cart')->where('uid',$uid)->where('gid',$id)->select('num')->first();
                //$num = DB::table('cart')->where('uid',$uid)->where('gid',$id)->first();
                //dd($num->num);
                $num = $num->num + 1;
                //dd($num);
                //将num字段压入库
                $res = DB::table('cart')->where('uid',$uid)->where('gid',$id)->update(['num'=>$num]);
                
                   
            }else{
                //不在 压入库里
                $res = DB::table('cart')->insert($cart);
            }
            
            
        }else{ //没有登录的情况下
            if(empty($_SESSION['car'][$id])){
                //echo id;
                //获取商品
                $data = DB::table('goods')->select('id','title','price')->where('id',$id)->first();
                $data->num = 1;
                $data->xiaoji = ($data->price * $data->num);
                $_SESSION['car'][$id] = $data;

            }else{
                //当前数量
                $_SESSION['car'][$id]->num = $_SESSION['car'][$id]->num + 1;
                $_SESSION['car'][$id]->xiaoji = ($_SESSION['car'][$id]->num * $_SESSION['car'][$id]->price);
            }
        }
        
        //dd($cart);

    	//获取商品
    	
    	//$data->num = 1;

    	

    	
    	//dd($_SESSION['car']);
    	return redirect('home/list');
    }

    //统计购物车 的 数据 总数量
    public static function countCar()
    {
    	// dump($_SESSION['car']);
    	if(empty($_SESSION['car'])){
    		$count = 0;
    	}else{
    		$count = 0;
    		foreach($_SESSION['car'] as $key => $value) {
    			$count += $value->num;
    		}
    	}
    	return $count;
    }

    //统计总价格
    public static function priceCount()
    {
        //判断是否登陆
        if(!empty(session('home_user'))){
            $uid = session('home_user')->id;
            $data = DB::table('cart')->where('uid',$uid)->get();
            $jj = [];
            $priceCount = 0;
            foreach($data as $k=>$v){
                $num = $v->num;
                $gid = $v->gid;

                $price = DB::table('goods')->where('id',$gid)->select('price')->get();
                //dump($v->num);
                //dump($price);
                foreach($price as $k=>$v){
                    $price=$v->price;
                }
                $priceCount += $price * $num;
                
            }
            
            return $priceCount;

        }else{
            if(empty($_SESSION['car'])){
                $priceCount = 0;
            }else{
                $priceCount = 0;
                foreach($_SESSION['car'] as $key => $value) {
                    $priceCount += $value->xiaoji;
                }
            }
            return $priceCount;
        }
    	
    }

    //添加
    public function goodsAdd(Request $request)
    {
        $type = $request->input('type');
        $num  = $request->input('num');
        //dd($num);
        $num = $num + $type;
        if($num <= 1){
            $num = 1;
        }
        
        // $data['uid'] = session('home_user')->id;
        // $data['gid'] = $request->input('gid');
        $uid = session('home_user')->id;
        $gid = $request->input('gid');
        //dd($num);
        //\DB::connection()->enableQueryLog();  // 开启QueryLog
        $res = DB::table('cart')->where(['uid'=>$uid,'gid'=>$gid])->update(['num'=>$num]);
        // $res = DB::table('cart')->where('uid',$uid)->where('gid',$gid)->update(['num'=>$num]);
        //dd(\DB::getQueryLog());
        if (!$res) {
           echo '111111';
        }
        // $data['num'] =
        // $data['creaeted_at'] = 

        //$res = DB::table('cart')->insert()->first();
        //$type = $type + $type;

        return $num;
    }

    //减少
    public function goodsJian()
    {

    }
}