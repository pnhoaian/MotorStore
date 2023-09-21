<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
session_start();

class HomeController extends Controller
{
    public function index(){
        //slide
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();

        //
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // return view('admin.all_product')->with('all_product', $all_product);
        
        return view('pages.home')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product',$all_product)
        ->with('slider',$slider);
    }
    
    public function search(Request $request){
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $keyword = $request->keyword_submit;
        
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        
        return view('pages.product.search')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('search_product',$search_product);
    }
}
