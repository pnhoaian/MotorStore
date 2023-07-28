<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        

        $product_id = $request->productid_hidden;
        $quantity = $request->soluong;

        $data = DB::table('tbl_product')->where('product_id',$product_id)->get();
    
        return view('pages.cart.show_cart')
        ->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
}
