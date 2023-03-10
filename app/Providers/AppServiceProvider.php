<?php

namespace App\Providers;

use App\Models\AddToCart;
use App\Models\CompanyContact;
use App\Models\CompanyInfo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once base_path().'/app/Http/Helpers/GlobalFunction.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if( Schema::hasTable('company_infos')){
            $site_info = CompanyInfo::first();
            $site_contact_info = CompanyContact::first();
            $cart_products = '';
            if(serviceCheck('Database Add To Cart')){
                $user_ip = request()->ip();
                $cart_products = AddToCart::where('ip_address',$user_ip)->orderBy('id','desc')->get();
                if(Auth::user()){
                    $cart_products = AddToCart::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
                }
            }

            view()->share('cart_products',$cart_products);
            view()->share('site_info',$site_info);
            view()->share('site_contact_info',$site_contact_info);
       }
    }
}
