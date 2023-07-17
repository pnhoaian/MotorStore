<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
session_start();

class BrandProduct extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $all_brand_product = DB::table('tbl_brand_product')->get(); 
        return view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        //return view('admin.all_brand_product');
    }

    public function save_brand_product(Request $request){
        $data = array();
        $data['brand_name'] = $request ->brand_product_name;
        $data['brand_desc']= $request ->brand_product_desc;
        $data['brand_status']= $request ->brand_product_status;

        //insert du lieu va tbl-brand-product
        DB::table('tbl_brand_product')->insert($data);
        $request->session()->put('message', 'Thêm Hãng - Thương hiệu thành công!');
        return Redirect::to('add-brand-product');
        //return view('admin.save_brand_product');
    }

    public function active_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' =>1]);
        Session::put('message','Đã hiện thị Hãng - Thương hiệu sản phẩm');
        return Redirect::to('all-brand-product');
    }

    public function inactive_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' =>0]);
        Session::put('message','Đã ẩn Hãng - Thương hiệu sản phẩm');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $all_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        return view('admin.edit_brand_product')->with('edit_brand_product', $all_brand_product);
        //return view('admin.all_brand_product');
    }

    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa Hãng - Thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }

    public function update_brand_product(Request $request, $brand_product_id){
        $data = array();
        $data['brand_name'] = $request ->brand_product_name;
        $data['brand_desc']= $request ->brand_product_desc;
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Đã cập nhật Hãng - Thương hiệu sản phẩm');
        return Redirect::to('all-brand-product');
    }
}
