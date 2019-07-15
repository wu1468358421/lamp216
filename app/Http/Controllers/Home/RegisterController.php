<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Users;
use Hash;
use Mail;

class RegisterController extends Controller
{
    //加载注册页面
    public function index()
    {
    	return view('home.register.index');
    }

    //执行邮箱注册 操作
    public function insert(Request $request)
    {
    	dump($request->all());
    	$upass = $request->input('upass');
    	$repass = $request->input('repass');
    	$email = $request->input('email');
    	//验证密码
    	if($upass != $repass){
    		echo "<script>alert('两次密码不一致');location.href='/home/register'</script>";
    		exit;
    	}
    	$token = str_random(30);
    	
    	$user = new Users;
    	$user->upass = Hash::make($upass);
    	$user->token = $token;
    	$user->email = $email;
    	$res1 = $user->save();
    	if($res1){
    		//发送邮件
	    	Mail::send('home.register.mail', ['id' => $user->id,'token'=>$token], function ($m) use ($email) {
	    		//to 发送地址 subject发送标题
	            $s = $m->to($email)->subject('【LAMPoto】提醒邮件！');
	            if($s){
	            	echo '用户注册成功，用户请尽快完成激活';
	            }
	        });
    	}

    	
    }

    //激活用户 邮件
    public function changeStatus($id,$token)
    {
    	//echo '激活-------'.$id;
    	$user = Users::find($id);
    	//验证token
    	if($user->token != $token){
    		dd('链接失效'); 
    	}

    	$user->status = 1;
    	$user->token = str_random(30);

    	if($user->save()){
    		echo '激活成功';
    	}else{
    		echo '激活失败';
    	}
    }

    //执行注册
    public function store(Request $request)
    {
    	

    	//验证手机验证码
    	$phone = $request->input('phone',0);

    	//获取发送到手机上的验证码
    	$k = $phone.'_code';
    	$phone_code = session($k);
    	$code = $request->input('code',0);
    	dump($code);
    	dump($phone_code);
    	if($code != $phone_code){
    		echo "<script>alert('验证码错误');location.href='/home/register'</script>";
    		exit;
    	}
    	dump($request->all());
    }

    //发送手机号 验证码
    public function sendPhone(Request $request)
    {
    	$phone = $request->input('phone');
    	
    	$code = rand(1234,4321);

    	//如果存入redis中注意键名覆盖
    	$k = $phone.'_code';
    	session([$k=>$code]);

    	//api短信接口
	    $url = "http://v.juhe.cn/sms/send";
		$params = array(
		    'key'   => '67beba54953138676717d74779586775', //您申请的APPKEY
		    'mobile'    => $phone, //接受短信的用户手机号码
		    'tpl_id'    => '168148', //您申请的短信模板ID，根据实际情况修改
		    'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
		    'dtype' => 'json'
		);

		$paramstring = http_build_query($params);
		$content = self::juheCurl($url, $paramstring);
		echo $content;
		$result = json_decode($content, true);
		if ($result) {
		    var_dump($result);
		}
    }

    //api短信接口
   
	/**
	 * 请求接口返回内容
	 * @param  string $url [请求的URL地址]
	 * @param  string $params [请求的参数]
	 * @param  int $ipost [是否采用POST形式]
	 * @return  string
	 */
	public static function juheCurl($url, $params = false, $ispost = 0)
	{
	    $httpInfo = array();
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    if ($ispost) {
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	        curl_setopt($ch, CURLOPT_URL, $url);
	    } else {
	        if ($params) {
	            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
	        } else {
	            curl_setopt($ch, CURLOPT_URL, $url);
	        }
	    }
	    $response = curl_exec($ch);
	    if ($response === FALSE) {
	        //echo "cURL Error: " . curl_error($ch);
	        return false;
	    }
	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
	    curl_close($ch);
	    return $response;
	}
}
