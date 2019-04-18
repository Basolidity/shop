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
//首页
Route::get('/', function () {
    return view('admin/index');
});


//中间件
Route::group([], function () {
//后台的路由组 

    //后台首页
    Route::get('/admins','Admin\IndexController@index');
    //管理员管理
    Route::resource('/admin/user','Admin\UserController');
    
});


//后台的登录页面
Route::get('/admin/login','Admin\LoginController@login');
Route::post('admin/dolgin','Admin\LoginController@dologin');