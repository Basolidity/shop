<?php

namespace App\Http\Controllers\Home\my_order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyOrderController extends Controller
{
    //
    public function index()
    {
        return view('home.myorder.index');
    }
}
