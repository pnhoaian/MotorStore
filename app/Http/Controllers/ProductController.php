<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
session_start();

class ProductController extends Controller
{
    public function add_product(){
        return view('admin.add_product');
    }

    public function all_product(){
        $all_product = DB::table('tbl_product')->get(); 
        return view('admin.all_product')->with('all_product', $all_product);
        //return view('admin.all_product');
    }

    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['product_desc']= $request ->product_desc;
        $data['product_status']= $request ->product_status;

        //insert du lieu va tbl-product
        DB::table('tbl_product')->insert($data);
        $request->session()->put('message', 'Thêm Sản phẩm thành công!');
        return Redirect::to('add-product');
        //return view('admin.save_product');
    }

    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' =>1]);
        Session::put('message','Đã hiện thị Sản phẩm sản phẩm');
        return Redirect::to('all-product');
    }

    public function inactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' =>0]);
        Session::put('message','Đã ẩn Sản phẩm sản phẩm');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $all_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        return view('admin.edit_product')->with('edit_product', $all_product);
        //return view('admin.all_product');
    }

    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa Sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function update_product(Request $request, $product_id){
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['product_desc']= $request ->product_desc;
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Đã cập nhật Sản phẩm sản phẩm');
        return Redirect::to('all-product');
    }
}
