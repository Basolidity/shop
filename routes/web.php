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

//后台中间件
Route::group(['middleware'=>'login'], function () {

//后台的路由组
    //默认路径
    Route::get('/', function () {
        return view('admin.index');
    });
    // 首页
    Route::get('/admin/index','Admin\IndexController@index');

    // 用户管理
    Route::resource('/admin/info','Admin\UserController');

    //退出登录
    Route::get('/admin/logout','Admin\LoginController@logout');

});

//后台的登录页面
Route::get('/admin/login','Admin\LoginController@login');
Route::post('/admin/dologin','Admin\LoginController@dologin');
//验证码路由
Route::get('/admin/captcha', 'Admin\LoginController@captcha');


//前台中间件
Route::group([],function () {

//前台的路由组

    
});

//前台登录页面
    Route::get('/home/login','Home\LoginController@login');
    Route::post('/home/dologin','Home\LoginController@dologin');

//前台注册页面
    Route::get('/home/regist','Home\RegistController@regist');
    Route::post('/home/doregist','Home\RegistController@doregist');