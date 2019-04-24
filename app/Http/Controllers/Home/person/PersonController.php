<?php

namespace App\Http\Controllers\Home\person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PersonController extends Controller
{
    //
    public function index(){
        // 管理中心
        $res = DB::table('users')->where('uname',session('qname'))->first();
        $photo = DB::table('users_info')->where('uid',$res->id)->first();
        return view('home.person.person',['photo'=>$photo]);
    }
}
