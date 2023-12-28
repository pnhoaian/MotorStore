<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Product;
use App\Models\CatePost;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Coupon;
use PDF;
use Toastr;
session_start();

class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return redirect('dashboard');
        }else{
            return redirect('admin')->send();
        }
    }

    public function manage_order(){
        $this->AuthLogin();
        // $all_order = DB::table('tbl_order')
        // ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        // ->select('tbl_order.*','tbl_customer.customer_name')
        // ->orderby('tbl_order.order_id','desc')->get();

        // $manager_order = view ('admin.order.manage_order')->with('all_order', $all_order);
        // return view('admin_layout')->with('admin.order.manage_order', $manager_order);
        $order = Order::orderBy('create_at','desc')->get();
        return view('admin.order.manage_order')->with(compact('order'));


    }
    public function view_order($order_code){
        $this->AuthLogin();
            $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
            $order = Order::where('order_code',$order_code)->get();
            foreach($order as $key => $ord){
                $customer_id = $ord->customer_id;
                $shipping_id = $ord->shipping_id;
                $order_status = $ord->order_status;
            }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach($order_details as $key =>$order_d){
            //bảng or_detail
            $product_coupon = $order_d->product_coupon;
        }
        if($product_coupon!='no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 1;
            $coupon_number = 0;
        }
        
        // $coupon = Coupon::where('coupon_code',$product_coupon)->first();
        // if($coupon->coupon_code!='no')
        // {

        // }
        // $coupon_condition = $coupon->coupon_condition;
        // $coupon_number = $coupon->coupon_number;

        return view('admin.order.view_order')->with(compact('order_details','customer','shipping','order','order_details_product','coupon','coupon_condition','coupon_number'));
    }

                                //IN ĐƠN HÀNG
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        return $checkout_code;
    }
}
