<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Customer;
use Session;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*',function($view){
            $customer1 = Customer::find(Session::get('customer_id'));
            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');
            $max_price_range = $max_price + 500000;
            $cate_product1 =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        //     $productt = Product::all()->count();
        // $postt = Post::all()->count();
        // $orderr = Order::all()->count();
        // $customerr = Customer::all()->count();
        // $adminn = Admin::all()->count();
        // $thongtinlienhe = Contact::where('info_id',1)->get();
        // $productbanchay = Product::orderBy('product_sold','DESC')->take(10)->get();
        // $productkhongbanduoc = Product::orderBy('product_sold','ASC')->take(10)->get();
        // $customerrrr = Customer::find(Session::get('customer_id'));

            $view->with('min_price',$min_price)
            ->with('max_price',$max_price)
            ->with('max_price_range',$max_price_range)
            ->with('customer1',$customer1)
            ->with('cate_product1',$cate_product1);
            // ->with('productt',$productt)
            // ->with('postt',$postt)
            // ->with('orderr',$orderr)
            // ->with('customerr',$customerr)
            // ->with('adminn',$adminn)
            // ->with('thongtinlienhe',$thongtinlienhe)
            // ->with('productbanchay',$productbanchay)
            // ->with('productkhongbanduoc',$productkhongbanduoc)
            // ->with('customerrrr',$customerrrr);

        });
    }
}
