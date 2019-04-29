<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\TypeModel;
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
      
       View::share(['restypes'=>$res]);
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
