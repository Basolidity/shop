<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\TypeModel;
use App\Model\Home\CatModel;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $type = new TypeModel;
        $res = $type->getType2();
        
        $cat = new CatModel;
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
                $carts[$k]->num = $v['num'];
            }
        }
        //View::share(['restypes'=>$res]);
        View::share(['restypes'=>$res,'carts'=>$carts]);
       // view::share('carts',$carts);
       //View::share(['restypes'=>$res,'carts'=>$carts]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
