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

        return view('admin.order.view_order')->with(compact('order_details','customer','shipping','order','order_details_product'));
        // $order_by_id = DB::table('tbl_order')
        // ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        // ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        // ->join('tbl_order_details','tbl_order.order_code','=','tbl_order_details.order_code')
        // ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')->first();

        // $manager_order_by_id = view ('admin.order.view_order')->with('order_by_id', $order_by_id);
        // return view('admin_layout')->with('admin.order.view_order', $manager_order_by_id);
    }
}
