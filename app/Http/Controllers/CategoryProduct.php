<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
session_start();

class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get(); 
        return view('admin.all_category_product')->with('all_category_product', $all_category_product);
        //return view('admin.all_category_product');
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request ->category_product_name;
        $data['category_desc']= $request ->category_product_desc;
        $data['category_status']= $request ->category_product_status;

        //insert du lieu va tbl-category-product
        DB::table('tbl_category_product')->insert($data);
        $request->session()->put('message', 'Thêm danh mục thành công!');
        return Redirect::to('add-category-product');
        //return view('admin.save_category_product');
    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' =>1]);
        Session::put('message','Đã hiện thị danh mục sản phẩm');
        return Redirect::to('all-category-product');
    }

    public function inactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' =>0]);
        Session::put('message','Đã ẩn danh mục sản phẩm');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        return view('admin.edit_category_product')->with('edit_category_product', $all_category_product);
        //return view('admin.all_category_product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('all-category-product');
    }

    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request ->category_product_name;
        $data['category_desc']= $request ->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Đã cập nhật danh mục sản phẩm');
        return Redirect::to('all-category-product');
    }
}

