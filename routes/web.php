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
// 用户管理
Route::resource('/admin/info','Admin\UserController');
=======

Route::get('/admin', function () {
    return view('welcome');
});

Route::resource('/admin/info',function(){
    return view('info');
});

Route::resource('/admin/info222',function(){
    return view('info');
});
>>>>>>> fbdc4cc3b213181be77c79f1972412d4adbd6b6d
