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


//默认路径
Route::get('/','Home\IndexController@index');

//后台中间件
Route::group(['middleware'=>['login','check']], function () {

//后台的路由组
    // 首页
    Route::get('/admininfo','Admin\AdminController@index');

    Route::get('/admin/index','Admin\IndexController@index');

    // 用户管理
    Route::resource('/admin/info','Admin\UserController');
    // 管理员管理
    Route::resource('/admin/adminuser','Admin\adminuser\UserController');
    //角色管理
    Route::resource('/admin/role','Admin\adminuser\RoleController');
    // 权限管理
    Route::resource('/admin/permission','Admin\adminuser\PermissionController');
    // 管理员状态
    Route::get('/admin/adminuser/status/{id}','Admin\adminuser\UserController@status');
    // 修改管理员密码
    Route::get('/admin/adminuser/pass/{id}','Admin\adminuser\UserController@pass');
    // 处理管理员修改密码
    Route::post('/admin/adminuser/dopass/{id}','Admin\adminuser\UserController@dopass');
    // 权限分类管理资源控制器
    Route::resource('admin/pertype','Admin\TypeController');
    Route::match(['get','post'],'admin/pertype/childtype/{id}','Admin\TypeController@childtype');

    //退出登录
    Route::get('/admin/logout','Admin\LoginController@logout');

    // 用户状态
    Route::get('/admin/status/{id}','Admin\UserController@status');

    // 修改密码
    Route::get('/admin/pass/{id}','Admin\UserController@pass');

    // 处理修改密码
    Route::post('/admin/dopass/{id}','Admin\UserController@dopass');
    
    // 批量删除
    Route::get('/admin/batch','Admin\UserController@batch');


    // 后台头像上传
    Route::post('/admin/upload','Admin\PersonController@upload');
    // 个人中心资源控制器
    Route::resource('/admin/person','Admin\PersonController');

    // 分类管理资源控制器
    Route::resource('admin/type','Admin\TypeController');
    Route::match(['get','post'],'admin/type/childtype/{id}','Admin\TypeController@childtype');
    Route::get('/admin/type/status/{id}','Admin\TypeController@status');

    // 商品管理资源控制器
    Route::resource('admin/goods','Admin\GoodsController');
    Route::get('admin/goods/status/{id}','Admin\GoodsController@gstatus');
    Route::match(['get','post'],'admin/goods/update/{id}','Admin\GoodsController@gupdate');
    Route::get('/admin/goods/delpic/{id}','Admin\GoodsController@delpic');
    Route::match(['get','post'],'admin/goods/gmodel/{id}','Admin\GoodsController@gmodel');
    Route::get('admin/goods/gmodel/list/{id}','Admin\GoodsController@gmodel_list');
    Route::get('admin/goods/edit/{id}','Admin\GoodsController@gmodel_edit');
    Route::post('admin/goods/edit/{id}','Admin\GoodsController@gmodel_update');
    Route::get('admin/gModel/display/{id}','Admin\GoodsController@gmodel_display');

    //轮播图
    Route::resource('admin/rotation','Admin\RotationController');

     //友情链接
    Route::resource('admin/link','Admin\LinkController');
});

//后台的登录页面
Route::get('/admin/login','Admin\LoginController@login');
Route::post('/admin/dologin','Admin\LoginController@dologin');

//验证码路由
Route::get('/admin/captcha', 'Admin\LoginController@captcha');
//无权限访问
Route::get('/admin/check', 'Admin\LoginController@check');




//前台中间件
Route::group(['middleware'=>'home'], function () {

//前台的路由组

    //退出登录
    Route::get('/home/logout','Home\LoginController@logout');
    // 前台管理中心
    Route::get('/home/person','Home\person\PersonController@index');
    // 前台头像上传
    Route::post('/home/upload','Home\person\PersonController@upload');
    // 个人信息修改
    Route::get('/home/person/update/{id}','Home\person\PersonController@update');
    // 设置默认
    Route::get('/home/site/depath/{sta}','Home\site\SiteController@depath');
    // 收货地址管理
    Route::resource('/home/site','Home\site\SiteController');
    // 购物车资源管理器
    Route::resource('/home/cart','Home\cart\CartController');
       // 订单页面
    Route::resource('/home/myorder','Home\my\MyOrderController');
    // 订单详情
    Route::get('/home/myorderinfo/{oid}','Home\my\MyOrderController@Orderinfo');

    //购物车
    Route::get('/home/cat/{gid}/{gmid}','Home\CatController@add');
    //购物车详情页
    Route::resource('/home/cart','Home\CatController');
     //订单页
    Route::get('/home/order','Home\OrderController@index');
    // 订单页修改地址
    Route::get('/home/order/edit','Home\OrderController@edit');
    // 选择地址
    Route::get('/home/order/depath/{id}','Home\OrderController@depath');

    //对订单进行操作
    Route::post('/home/settlement','Home\OrderController@settlement');
    //结算成功的页面
    Route::get('/home/settlements/{oid}/{sid}','Home\OrderController@settlements');
    //详情页用的
    Route::get('/home/addcat','Home\CatController@addcart');
    // 我的订单
    Route::get('/home/myorder','Home\my_order\MyOrderController@index');


});


    
//首页
    Route::get('/home/index','Home\IndexController@index');

//前台登录页面
    Route::get('/home/login','Home\LoginController@login');
    Route::post('/home/dologin','Home\LoginController@dologin');
//忘记密码
    Route::get('/home/forget','Home\LoginController@forget');
    Route::get('/home/forphone','Home\LoginController@forphone');
    Route::get('/home/duanphone','Home\LoginController@duanphone');
    Route::post('/home/doforget','Home\LoginController@doforget');

//前台注册页面
    Route::get('/home/regist','Home\RegistController@regist');
    Route::get('/home/doregist','Home\RegistController@doregist');
    Route::get('/home/checkphone','Home\RegistController@checkphone');
    Route::get('/home/codephone','Home\RegistController@codephone');
    Route::get('/home/checkcode','Home\RegistController@checkcode');
    Route::post('/home/formregist','Home\RegistController@formregist');


//前台商品详情
    Route::get('/home/goods/{id}','Home\GoodsController@index');
    Route::get('/home/list/{id}','Home\GoodsController@list');
   


