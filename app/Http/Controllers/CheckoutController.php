<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Customer;
use Toastr;
session_start();

class CheckoutController extends Controller
{
    public function login(){
        return view('pages.customer.user_login');
    }

    public function register(){
        return view('pages.customer.user_register');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();

    if($result){
        Session::put('customer_id',$result->customer_id);
        Session::put('customer_name',$result->customer_name);
        Session::put('customer_email',$result->customer_email);
        Session::put('customer_phone',$result->customer_phone);
        Session::put('customer_address',$result->customer_address);

        return redirect::to('/trang-chu');
    }
    }

    public function register_customer(Request $request){
        $data = $request->all();
        $customer = new Customer();
        $customer ->customer_name = $data['customer_name'];
        $customer ->customer_email = $data['customer_email'];
        $customer ->customer_phone = $data['customer_phone'];
        $customer ->customer_address = $data['customer_address'];
        $customer ->customer_password = md5($data['customer_password']);
        $customer->save();

        // Toastr::success('Đăng ký thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
      
        return Redirect::to('/login');

    }


    public function logout_customer(Request $request){
        Session::flush();
        return redirect::to('/trang-chu');
    }

    public function checkout(Request $request){
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        return view('pages.checkout.show_checkout')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_post',$category_post);
    }

}
