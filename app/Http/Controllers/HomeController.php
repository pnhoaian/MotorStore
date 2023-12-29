<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Product;
use App\Models\CatePost;
use Toastr;
session_start();

class HomeController extends Controller
{
    public function index(){

        //slide
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',0)->take(4)->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        //post
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(5)->get();
        $all_sdp = DB::table('tbl_product')->where('product_status','1')->where('category_id','9')->orderby('product_id','desc')->limit(5)->get();
        $all_ds = DB::table('tbl_product')->where('product_status','1')->where('category_id','8')->orderby('product_id','desc')->limit(5)->get();
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $max_price_range = $max_price + 500000;
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // return view('admin.all_product')->with('all_product', $all_product);
        
        return view('pages.home')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product',$all_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('all_sdp',$all_sdp)
        ->with('all_ds',$all_ds)
        ->with('min_price',$min_price)
        ->with('max_price',$max_price)
        ->with('max_price_range',$max_price_range)
        ;
    }
    
    public function search(Request $request){
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $keyword = $request->keywords_submit;
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        
        $search_product_count = $search_product->count();
        return view('pages.product.search')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('search_product',$search_product)
        ->with('search_product_count',$search_product_count);
    }
}
