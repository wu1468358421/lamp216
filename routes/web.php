<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#  / 根路径 

// 代表  服务器上的绝对地址 : 域名后面 以 / 开头的字符串
// Route::get('/匹配服务器上的绝对地址'，'callbackk');


// Route 路由
Route::get('/', function () {
	// 设置
	Config::set('app.title','hello 215');

});

//后台登陆页面
Route::get('admin/login','Admin\LoginController@login');
//后台 执行 登陆
Route::post('admin/dologin','Admin\LoginController@dologin');
Route::get('admin/outlogin','Admin\LoginController@outlogin');

Route::get('admin/rbac',function(){
	return view('admin.rbac');
});

// Route::get('admin/rbac',function(){
// 	return view('admin.rbac');
// });

Route::group(['middleware'=>['login']],function(){
	//后台首页的路由
	Route::get('admin','Admin\IndexController@index');
	//后台用户路由
	Route::resource('admin/users','Admin\UsersController');
	//后台分类的路由
	Route::resource('admin/cates','Admin\CatesController');
	//后台管理员
	Route::resource('admin/adminuser','Admin\AdminUserController');
	//后台角色
	Route::resource('admin/roles','Admin\RolesController');
	//后台权限
	Route::resource('admin/nodes','Admin\NodesController');
	//后台栏目管理
	Route::get('admin/column','Admin\ColumnController@index');
	//后台栏目添加
	Route::get('admin/column/create','Admin\ColumnController@create');
	//后台栏目添加 储存
	Route::get('admin/column/store','Admin\ColumnController@store');
	//后台栏目添加 修改
	Route::get('admin/column/edit/{id}','Admin\ColumnController@edit');
	//后台栏目添加 修改 提交
	Route::get('admin/column/update/{id}','Admin\ColumnController@update');
	//后台栏目添加 修改 提交
	Route::get('admin/column/destroy/{id}','Admin\ColumnController@destroy');

	//后台商品 管理
	Route::post('admin/goods/getCate', 'Admin\GoodsController@getCate');
	Route::resource('admin/goods','Admin\GoodsController');

	//后台品牌 管理
	Route::resource('admin/brand','Admin\BrandController');
});


//前台首页
Route::resource('home/index','Home\IndexController');

//前台注册 邮箱 手机号
Route::get('home/register','Home\RegisterController@index');
//前台注册 邮箱 手机号
Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');
//前台注册 手机号
Route::post('home/register/store','Home\RegisterController@store');
//前台注册 邮箱
Route::post('home/register/insert','Home\RegisterController@insert');
//前台注册 邮箱
Route::get('home/register/changeStatus/{id}/{token}','Home\RegisterController@changeStatus');
//前台登陆页面
Route::get('home/login','Home\LoginController@login');
//前台 执行 登陆
Route::post('home/dologin','Home\LoginController@dologin');
//前台 执行 退出登陆
Route::get('home/outlogin','Home\LoginController@outLogin');

//商品列表页面
Route::get('home/list','Home\ListController@index');

//加入购物车
Route::get('home/car/add','Home\CarController@add');

//购物车主页面
Route::get('home/car/index','Home\CarController@index');
//购物车 添加
Route::get('home/car/goodsadd','Home\CarController@goodsAdd');
//购物车 减少
Route::get('home/car/goodsjian','Home\CarController@goodsJian');
//添加后台用户
//Route::get('insert','InsertController@index');

//结算页面
Route::get('home/order/account','Home\OrderController@account');
