<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
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
        // if(isset($result))
        // {
        //     return view('admin.dashboard');
        // }

        if ($result) {
			Session::put('admin_name',$result->admin_user);
			Session::put('admin_id',$result->admin_id);
			return Redirect::to('/dashboard');
		}else{
			Session::put('message','Tài khoản hoặc mật khẩu không chính xác !');
			return Redirect::to('/admin');
		}
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        // return Redirect::to('admin.dashboard');
        return redirect('admin');
    }
}
