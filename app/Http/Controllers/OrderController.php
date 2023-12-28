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
            $product_coupon = $order_d->Product_coupon;
        }
        if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
            // Lấy giá trị bảng order_detail đối chiếu để lấy số tiền giảm bảng Coupon
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==0){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==1){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}
        
         
        // if($coupon->coupon_code!='no')
        // {
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
        // }
        // $coupon_condition = $coupon->coupon_condition;


        return view('admin.order.view_order')->with(compact('order_details','customer','shipping','order','order_details_product','coupon','coupon_condition','coupon_number'));
    }

                                //IN ĐƠN HÀNG
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));	
		return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::with('product')->where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

        foreach($order_details as $key =>$order_d){
            //bảng or_detail
            $product_coupon = $order_d->Product_coupon;
        }
        if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
            // Lấy giá trị bảng order_detail đối chiếu để lấy số tiền giảm bảng Coupon
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==0){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==1){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
        }
        $output = '';

        $output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}

        </style> 
        <p>Công ty TNHH MTV Hoài An Store</p>
        <p>Địa chỉ: 180 Cao lỗ, Phường 4, Quận 8, Tp HCM</p>
        <p>Hotline: 093 9999 999</p>
        <h1><center>PHIẾU MUA HÀNG</center></h1>

            <table>
                <thead>
                <h4>Thông tin người nhận: </h4>
                    <p> Tên người nhận: '.$customer->customer_name.'</p>
                    <p> Số điện thoại: '.$customer->customer_phone.'</p>
                    <p> Địa chỉ: '.$customer->customer_address.'</p>
                    <p> Ghi chú: '.$customer->shipping_note.'</p>
                </thead>

                <tbody>';
                
                
                
                $output.=' 
                </tbody>

            </table>
            <h4>Thông tin đơn hàng </h4>
            <table class="table-styling">

                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>';
                $i=0;
                $total = 0;
                foreach($order_details_product as $key => $product){
                    $i++;
                $subtotal = $product->Product_price * $product->Product_sales_quantity;
                $total +=$subtotal;
                    if($product->Product_coupon !='no'){
                        $Product_coupon = $product->Product_coupon;
                    }else{
                        $Product_coupon = 'Không có mã khuyến mãi';
                    }

                $output.='
                    <tr >
                        <td style="text-align: center;">'.$i.'</td>
                        <td>'.$product->Product_name.'</td>
                        <td style="text-align: center;">'.$product->Product_sales_quantity.'</td>
                        <td style="text-align: center;">'.number_format($product->Product_price, 0, ',', '.') . ' '  .'</td>
                        <td style="text-align: center;">'.number_format($subtotal, 0, ',', '.') . ' '  .'</td>

                    </tr>';
                }
                if($coupon_condition == 2){
                    //Phần trăm sau giảm
                    $total_after_coupon = ($total * $coupon_number)/100;
                    //Tổng tiền thanh toán
                    $total_coupon = $total - $total_after_coupon;
                }else{
                    $total_coupon = $total - $coupon_number;
                }

                //Phí ship
                if($total > 500000){
                    //Tổng tiền thanh toán
                    $fee = 0;
                }else{
                    $fee = 20000;
                }

                $output.=' 
                    <tr >
                        <td colspan="5">
                            <p style="margin-left:480px">Phí Ship: '. number_format($fee, 0, ',', '.') . ' ' . '₫' .'</p>
                            <p style="margin-left:480px">Khuyến mãi: '. number_format($fee, 0, ',', '.') . ' ' . '₫' .'</p>
                            <p style="margin-left:480px">Số tiền thu: '.number_format($total +  $fee, 0, ',', '.') . ' ' . '₫'.'</p>
                        </td>
                    </tr>
                ';

                $output.=' 

                </tbody>
            </table>
            <h4>Chữ ký xác nhận: </h4>
            <table>

                <thead>
                    <tr>
                        <th width=250px>Chữ ký người nhận</th>
                        <th width=600px>Chữ ký nhân viên</th>
                    </tr>
                </thead>

                <tbody>';
                
                
                $output.=' 
                </tbody>

            </table>

        
        ';



        return $output;
    }
}
