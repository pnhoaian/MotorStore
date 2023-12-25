<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Statistic;
use Toastr;
session_start();

class AdminController extends Controller
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
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $admin_user = $request->admin_user;
        $admin_password = md5($request->admin_password);
        
        $result = DB::table('tbl_admin')-> where('admin_user',$admin_user)->where('admin_password',$admin_password)->first();
        if ($result) {
			Session::put('admin_name',$result->admin_user);
			Session::put('admin_id',$result->admin_id);
            Toastr::success('Đăng nhập thành công.','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
			
			return Redirect::to('/dashboard');
		}else{
            Toastr::error('Tài khoản hoặc mật khẩu không chính xác','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
			return Redirect::to('/admin');
		}
    }

    public function logout(){
        // $this->AuthLogin();
        // Session::put('admin_name',null);
        // Session::put('admin_id',null);

        Session::flush();
        // return Redirect::to('admin.dashboard');
        return Redirect::to('/admin');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['form_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','asc')->get();

        foreach($get as $key =>$val){
            $chart_data[]= array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function order_date(Request $request){
        $order_date = $_GET['date'];
        $order = Order::where('order_date',$order_date)->orderBy('create_at','desc')->get();
        return view('admin.order_date')->with(compact('order'));
    }
}
