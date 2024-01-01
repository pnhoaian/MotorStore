<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use App\Models\CatePost;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Coupon;
use Carbon\Carbon;
use PDF;
use Mail;
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

    public function history(){
        if(!Session::get('customer_id')){
            return redirect('login');
        }else{
            $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',0)->take(4)->get();
            $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
            //post
            $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
            $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
            
            $all_sdp = DB::table('tbl_product')->where('product_status','1')->where('category_id','9')->orderby('product_id','desc')->limit(5)->get();
            $all_ds = DB::table('tbl_product')->where('product_status','1')->where('category_id','8')->orderby('product_id','desc')->limit(5)->get();
            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');
            $max_price_range = $max_price + 500000;

            $getorder = Order::where('customer_id',Session::get('customer_id'))->orderBy('order_date','desc')->get();
            // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
            // ->orderby('tbl_product.product_id','desc')->get();
            // return view('admin.all_product')->with('all_product', $all_product);
            
            return view('pages.history.history')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('slider',$slider)
            ->with('slidermini',$slidermini)
            ->with('category_post',$category_post)
            ->with('all_sdp',$all_sdp)
            ->with('all_ds',$all_ds)
            ->with('min_price',$min_price)
            ->with('max_price',$max_price)
            ->with('max_price_range',$max_price_range)
            ->with('getorder',$getorder)
            ;
        }
    }

    public function view_history_order($order_code){
        if(!Session::get('customer_id')){
            return redirect('login');
        }else{
            $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',0)->take(4)->get();
            $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
            //post
            $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
            $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
            
            $all_sdp = DB::table('tbl_product')->where('product_status','1')->where('category_id','9')->orderby('product_id','desc')->limit(5)->get();
            $all_ds = DB::table('tbl_product')->where('product_status','1')->where('category_id','8')->orderby('product_id','desc')->limit(5)->get();
            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');
            $max_price_range = $max_price + 500000;

            //Xem lịch sử ĐH           
            $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
            $getorder = Order::where('order_code',$order_code)->first();

                $customer_id = $getorder->customer_id;
                $shipping_id = $getorder->shipping_id;
                $order_status = $getorder->order_status;

            $order = Order::where('order_code',$order_code)->first();
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

            return view('pages.history.view_history')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('slider',$slider)
            ->with('slidermini',$slidermini)
            ->with('category_post',$category_post)
            ->with('all_sdp',$all_sdp)
            ->with('all_ds',$all_ds)
            ->with('min_price',$min_price)
            ->with('max_price',$max_price)
            ->with('max_price_range',$max_price_range)
            ->with('getorder',$getorder)
            ->with('order_details',$order_details)
            ->with('customer',$customer)
            ->with('shipping',$shipping)
            ->with('order_details_product',$order_details_product)
            ->with('order',$order)
            ->with('order_code',$order_code)
            ->with('coupon_condition',$coupon_condition)
            ->with('coupon_number',$coupon_number)
            ;
        }
    }

    public function manage_order(){
        $this->AuthLogin();
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

    public function update_qty(Request $request){
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	
	}


//update tình trạng đơn hàng
    public function update_order_qty(Request $request){
        $data = $request->all();
        
        //lấy thông tin order
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
		$order->save();

        $data['order_status']= $request ->order_status;

        //Send mail confirm
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        // $title_mail = "Hoài An Store | Xác nhận đơn đặt hàng ngày ".' '.$now;
        $title_mail = "Hoài An Store | Đơn hàng đã được xác nhận đặt hàng và tiến hành đóng gói";

        $customer = Customer::where('customer_id',$order->customer_id)->first();

        $data['email'][] = $customer->customer_email;


		   foreach($data['order_product_id'] as $key => $product){
			$product_mail = Product::find($product);
			   foreach($data['quantity'] as $key2 => $qty){
				if($key ==$key2){
				   $cart_array[] = array(
                    'product_name' => $product_mail['product_name'],
                    'product_price' => $product_mail['product_price'],
                    'product_qty' => $qty,
                    
				   );
			   }
		   }
		}


        $details = OrderDetails::where('order_code',$order->order_code)->first();
		$fee_ship = $details->product_feeship;
		$coupon_mail = $details->product_coupon;


        //lấy thông tin voucher
        if(Session::get('coupon')!=NULL){
            $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
           
            $coupon_mail = $coupon->coupon_code;
            $coupon_mail_method = $coupon->coupon_condition;
            $coupon_mail_number = $coupon->coupon_number;
            $coupon->save();
            }else{
                $coupon_mail = 'không có';
                $coupon_mail_method ='';
                $coupon_mail_number = '';
            }

    
        $shipping = Shipping::where('shipping_id',$order->shipping_id)->first();
        //
        $shipping_array = array(
           'customer_name' =>$customer->customer_name,
           'shipping_name' =>$shipping->shipping_name,
           'shipping_email' =>$shipping->shipping_email,
           'shipping_phone' =>$shipping->shipping_phone,
           'shipping_address' =>$shipping->shipping_address,
           'shipping_note' =>$shipping->shipping_note,
           'shipping_method_receive' =>$shipping->shipping_method_receive,
           'shipping_method_pay' =>$shipping->shipping_method_pay,
        );

        // $ordercode_mail = array(
        //    'coupon_code' =>$coupon_mail,
        //    'order_code' =>$checkout_code
        // );
        
        $ordercode_mail = array(
            'coupon_code' =>$coupon_mail,
            'order_code' =>$details->order_code
         );
       
      


       Mail::send('pages.mail.confirm_order',
        ['cart_array'=>$cart_array,
        'shipping_array'=>$shipping_array,
        'code'=>$ordercode_mail],
        function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
            
        });


        // DB::table('tbl_order')->where('order_code',$order_code)->update($data);
        Toastr::success('Đã cập nhật tình trạng đơn hàng!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('manage-order');
    }

    public function delete_order($order_code){
        $this->AuthLogin();
        $order_details = OrderDetails::find($order_code);
        $order_details->delete();
        $coupon->delete();

        Toastr::warning('Xóa đơn hàng thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('/manage-order');
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
