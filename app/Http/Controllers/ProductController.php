<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
session_start();

class ProductController extends Controller
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

    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        return view('admin.all_product')->with('all_product', $all_product);
        //return view('admin.all_product');
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['category_id']= $request->product_cate;
        $data['brand_id']= $request->product_brand;
        $data['product_desc']= $request ->product_desc;
        $data['product_image']= $request ->product_image;
        $data['product_price']= $request ->product_price;
        $data['product_status']= $request ->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
            //lấy tên file hình ảnh
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            $request->session()->put('message', 'Thêm Sản phẩm thành công!');
            return Redirect::to('all-product');
        }
        //insert du lieu va tbl-product
        $data['product_image']='';
        DB::table('tbl_product')->insert($data);
        $request->session()->put('message', 'Thêm Sản phẩm thành công!');
        return Redirect::to('add-product');
        //return view('admin.save_product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' =>1]);
        Session::put('message','Đã hiện thị Sản phẩm sản phẩm');
        return Redirect::to('all-product');
    }

    public function inactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' =>0]);
        Session::put('message','Đã ẩn Sản phẩm sản phẩm');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product =DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        return view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        //return view('admin.all_product');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa Sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['category_id']= $request->product_cate;
        $data['brand_id']= $request->product_brand;
        $data['product_desc']= $request ->product_desc;
        // $data['product_image']= $request ->product_image;
        $data['product_price']= $request ->product_price;
        $data['product_status']= $request ->product_status;
        
        $get_image = $request->file('product_image');
        if($get_image){
            //lấy tên file hình ảnh
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            $request->session()->put('message', 'Cập nhật Sản phẩm thành công!');
            return Redirect::to('all-product');
    }
    //End Admin Page

    public function detail_product($product_id){
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
       
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        return view('pages.product.show_detail')
        ->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
}
