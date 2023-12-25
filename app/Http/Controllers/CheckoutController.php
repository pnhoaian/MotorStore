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

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $_id = Session::get('customer_id');
        if($customer_id)
        {
            return redirect('trang-chu');
        }else{
            return redirect('login')->send();
        }
    }

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
        Toastr::success('Đăng nhập thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
      
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

        Toastr::success('Vui lòng đăng nhập tài khoản','Đăng ký thành công! !', ["positionClass" => "toast-top-right","timeOut" => "3000","progressBar"=> true,"closeButton"=> true]);
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
        Toastr::info(' Vui lòng kiểm tra thông tin nhận hàng','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);

        return view('pages.checkout.show_checkout')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_post',$category_post);
    }

    public function save_checkout_customer(Request $request){
    $data = array();
    $data['shipping_name'] = $request->shipping_name;
    $data['shipping_phone'] = $request->shipping_phone;
    $data['shipping_email'] = $request->shipping_email;
    $data['shipping_note'] = $request->shipping_note;
    $data['shipping_address'] = $request->shipping_address;
    $data['shipping_method_receive'] = $request->shipping_method_receive;
    $data['shipping_method_pay'] = $request->shipping_method_pay;
    $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    Session::put('shipping_id',$shipping_id);
    return Redirect('/payment');
    }

    public function payment(){
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        
        return view('pages.checkout.show_checkout')
        ->with('category', $cate_product)
        ->with('category_post',$category_post)
        ->with('brand', $brand_product);
    }


    public function my_information(Request $request){
    $customer = Customer::find(Session::get('customer_id'));
    $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
    $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();

    return view('pages.customer.info')
    ->with('category',$cate_product)
    ->with('brand',$brand_product)
    ->with('category_post',$category_post)
    ->with('customer',$customer);
    }

    public function update_information(Request $request, $customer_id){
        $data = $request->all();
        $customer = Customer::find($customer_id);
        $customer->customer_name= $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_address = $data['customer_address'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();
        Toastr::success('Cập nhật thông tin thành công.','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect('/my-information');
    }

}
