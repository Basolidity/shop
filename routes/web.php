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


    // 头像上传
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
});

//后台的登录页面
Route::get('/admin/login','Admin\LoginController@login');
Route::post('/admin/dologin','Admin\LoginController@dologin');
//验证码路由
Route::get('/admin/captcha', 'Admin\LoginController@captcha');
//404
Route::get('/admin/check', 'Admin\LoginController@check');




//前台中间件
Route::group(['middleware'=>'home'], function () {

//前台的路由组

    //退出登录
    Route::get('/home/logout','Home\LoginController@logout');
    // 前台管理中心
    Route::get('/home/person','Home\person\PersonController@index');
    
});


    
//首页
    Route::get('/home/index','Home\IndexController@index');

//前台登录页面
    Route::get('/home/login','Home\LoginController@login');
    Route::post('/home/dologin','Home\LoginController@dologin');
//忘记密码
    Route::get('/home/forget','Home\LoginController@forget');

//前台注册页面
    Route::get('/home/regist','Home\RegistController@regist');
    Route::post('/home/doregist','Home\RegistController@doregist');

//前台商品详情
    Route::get('/home/goods/{id}','Home\GoodsController@index');
   


