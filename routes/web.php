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
Route::get('/', function () {
    return view('admin.index');
});
// 首页
Route::get('/admin/index','Admin\IndexController@index');

<<<<<<< HEAD
// 用户状态
Route::get('/admin/status','Admin\UserController@status');
// 修改密码
Route::get('/admin/pass/{id}','Admin\UserController@pass');
// 处理修改密码
Route::POST('/admin/dopass/{id}','Admin\UserController@dopass');
// 用户管理
Route::resource('/admin/info','Admin\UserController');
=======
// 用户管理
Route::resource('/admin/info','Admin\UserController');

>>>>>>> 0668f58b3110de9091341e597360b7adaee2e335
