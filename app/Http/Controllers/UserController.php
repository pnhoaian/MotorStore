<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderBy('admin_id','desc')->paginate(5);
        return view('admin.user.all_user')->with(compact('admin'));
    }

    public function add_user(){
        return view('admin.user.add_user');
    }

    public function assign_roles(Request $request){
        $data = $request->all();
        $user = Admin::where('admin_user',$data['admin_user'])->first();
        $user->roles()->detach();
        if($request['author_role']){
            $user->role()->attach(Roles::where('name','author')->first());
        }
        if($request['user_role']){
            $user->role()->attach(Roles::where('name','user')->first());
        }
        if($request['admin_role']){
            $user->role()->attach(Roles::where('name','admin')->first());
        }
        return redirect()->back();
    }

    public function store_user(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_user = $data['admin_user'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        Session::put('message','Thêm User mới thành công');
        return redirect('users');
    }
}
