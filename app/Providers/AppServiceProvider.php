<?php

namespace App\Providers;

use App\View\Composers\PostComposer;
use Illuminate\Support\Facades\View;
use App\Models\Carts;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $config = Configuration::first();
            $view->with('config', $config);
            if (Auth::check()) {
                $cart = Carts::where(['user_id' => Auth::user()->id])->count();
                $view->with('cart', $cart);
            }
        });
    }
}
