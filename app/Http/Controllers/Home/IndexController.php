<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;

use App\Model\Home\GoodsModel;
use App\Model\Home\CatModel;
use DB;
class IndexController extends Controller
{
    //前台首页
    public function index()
    {   
        // 加载前台公共页面
        $good = new GoodsModel();
        $cat = new CatModel;
     	$res = array_slice($good->getgodds(10),0,6);
     	//dump($res);
     	$goodschilden = [];
     	foreach ($res as $key => $value) {
     		# code...
     		$goodschilden[] = $good->firstgoods($value->id);
     	}
     	//dump(session('qname'));
        $carts =[];
        if(session('qname')){
             //根据用户名获取用户id
            $uid = $cat->findUid(session('qname'));
            $uid = $uid->id;
            $cart = $cat->getCart($uid);
            //dump($cart);
           
            foreach($cart as $k =>$v){
               
                $carts[$k] = $cat->getGoods($v['gid']);
                $goods_model = $cat->getGoodsModel($v['gmid']);
                $carts[$k]->price = $goods_model->price;
                $carts[$k]->type = $goods_model->type;
                $carts[$k]->kc = $goods_model->num;
                $carts[$k]->num = $v['num'];
                $carts[$k]->id = $v['id'];
            }
            // dump($carts);
        }

        //轮播图
        $tu = DB::table('lunbo')->get();
        // dd($tu);

        //友情链接
        $links = DB::table('links')->get();
        // dd($links);
        $fw = DB::table('fangwen')->where('id',1)->first();
        // dd($fw->fw);
        $num = $fw->fw;
        $num++;


        DB::table('fangwen')->where('id',1)->update(['fw'=>$num]);
        return view('home.index.index',['res'=>$res,'tup'=>$goodschilden,'carts'=>$carts,'tu'=>$tu,'links'=>$links]);
        
    }

    //购物车
    public function cart()
    {
        //return view('');
    }
}
