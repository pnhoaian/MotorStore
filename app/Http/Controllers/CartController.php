<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Session;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Coupon;
use App\Models\Slider;
use Carbon\Carbon;
use App\Models\CategoryPostModel;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
use Cart;
use Toastr;
session_start();

class CartController extends Controller
{
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon==true){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code'=>$coupon->coupon_code,
                            'coupon_condition'=>$coupon->coupon_condition,
                            'coupon_number'=>$coupon->coupon_number
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code'=>$coupon->coupon_code,
                        'coupon_condition'=>$coupon->coupon_condition,
                        'coupon_number'=>$coupon->coupon_number
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Coupon khuyến mãi đã được áp dụng');
            }
        }else{
            return redirect()->back()->with('error','Coupon khuyến mãi đã không đúng hoặc hết hạn');
        }
    }
    //gio-hang
    public function show_cart(Request $request){
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        return view('pages.cart.show_cart')
        ->with('slider',$slider)
        ->with('category_post',$category_post)
        ->with('category', $cate_product)
        ->with('slidermini',$slidermini)
        ->with('brand', $brand_product);
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key] = array(
                    'session_id' => $val['session_id'],
                    'product_name' => $val['product_name'],
                    'product_id' => $val['product_id'],
                    'product_image' => $val['product_image'],
                    'product_qty' => $val['product_qty']+ $data['cart_product_qty'],
                    'product_price' => $val['product_price'],
                    'product_price_sale' => $val['product_price_sale']
                    );
                    Session::put('cart',$cart);
                }

            }
            if($is_avaiable==0){
                $cart[] = array(
                    'session_id' =>  $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                    'product_price_sale' => $data['cart_product_price_sale']
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                'product_price_sale' => $data['cart_product_price_sale']
            );
            Session::put('cart',$cart);
        }
        
        Session::save();
    }

    public function delete_product($session_id){
        $cart = Session::get('cart');
        if($cart == true)
        {
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
           Session::put('cart',$cart);
           return redirect()->back()->with('message','Cập nhật số lượng thành công');
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }
    }

    public function del_all_product(){
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Đã xóa tất cả sản phẩm trong giỏ hàng');
        }
    }

    public function save_cart(Request $request){
        // $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        // $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();
        // $product_id = $request->productid_hidden;
        // $quantity = $request->soluong;

        // $data = DB::table('tbl_product')->where('product_id',$product_id)->get();
        // $data['id'] = $product_info->product_id;
        // $data['qty'] = $quantity;
        // $data['name'] = $product_info->$product_name;
        // $data['price'] = $product_info->$product_price;
        // $data['options']['image']=$product_info->$product_image;
        // Cart::add($data);
        // return redirect('/show-cart');
        // $productId = $request->productid_hidden;
        // $quantity = $request->soluong;
        // $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

        // $data['id'] = $product_info->product_id;
        // $data['qty'] = $quantity;
        // $data['name'] = $product_info->product_name;
        // $data['price'] = $product_info->product_price;
        // $data['weight'] = '123';
        // $data['options']['image'] = $product_info->product_image;

        // Cart::add($data);
        // Cart::setGlobalTax(0);
        // // Cart::destroy();
        // return Redirect::to('/show-cart');

    }
}
