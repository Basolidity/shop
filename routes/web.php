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

// 用户管理
Route::resource('/admin/info','Admin\UserController');
