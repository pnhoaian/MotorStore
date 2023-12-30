<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;
use Toastr;
use Session;
session_start();

class CouponController extends Controller
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

    public function unset_coupon(){
        $this->AuthLogin();
        $coupon = Session::get('coupon');
        if($coupon==true){
            Session::forget('coupon');
            return redirect()->back()->with('message','Đã xóa mã Coupon khuyến mãi');
        }
    }
    public function insert_coupon(){
        $this->AuthLogin();
        return view('admin.coupon.insert_coupon');
    }

    public function insert_coupon_code(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $data = $request->validate(
            [
                'coupon_name' => 'required|unique:tbl_coupon',   
                'coupon_code' => 'required',
                'coupon_times' => 'required|numeric',
                'coupon_number' => 'required|numeric',

                // thiếu ngày bắt đầu - kết thúc    
            ],
            [
                'coupon_name.required' => 'Yêu cầu nhập tên chương trình khuyến mãi',
                'coupon_name.unique' => 'Đã có chương trình khuyến mãi trong hệ thống',
                'coupon_code.required' => 'Yêu cầu nhập mã khuyến mãi ',
                'coupon_times.required' => 'Yêu cầu nhập số lượng Coupon khuyến mãi ',
                'coupon_times.numeric' => 'Không phải định dạng số ',
                'coupon_number.required' => 'Yêu cầu nhập "SỐ TIỀN" hoặc "PHẦN TRĂM KHUYẾN MÃI" ',
                'coupon_number.numeric' => 'Không phải định dạng số ',
            ]
            );

        
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->save();

        Toastr::success('Thêm mã khuyến mãi thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return redirect('/list-coupon');
    }
    public function delete_coupon($coupon_id){
        $this->AuthLogin();
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Toastr::warning('Đã xóa mã khuyến mãi!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        // return redirect('admin.coupon.list_coupon');
        return redirect('/list-coupon');
    }


    public function list_coupon(){
        $this->AuthLogin();
        $coupon = Coupon::orderby('coupon_id','desc')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
}
