<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Slider;
session_start();

class BrandProduct extends Controller
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
    
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();
        //DB
        // $all_brand_product = DB::table('tbl_brand')->get(); 

        //model
        $all_brand_product = Brand::orderBy('brand_id','desc')->get();
        return view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        //return view('admin.all_brand_product');
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request ->brand_product_name;
        // $data['brand_desc']= $request ->brand_product_desc;
        // $data['brand_status']= $request ->brand_product_status;

        //insert du lieu va tbl-brand-product
        // DB::table('tbl_brand')->insert($data);

        $request->session()->put('message', 'Thêm Hãng - Thương hiệu thành công!');
        return Redirect::to('add-brand-product');
        //return view('admin.save_brand_product');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' =>1]);
        Session::put('message','Đã hiện thị Hãng - Thương hiệu sản phẩm');
        return Redirect::to('all-brand-product');
    }

    public function inactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' =>0]);
        Session::put('message','Đã ẩn Hãng - Thương hiệu sản phẩm');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        //C1: DB
        // $all_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        
        //C2: Model + foreach
        //$edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();

        //C3: Model
        $edit_brand_product = Brand::find($brand_product_id);
        return view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa Hãng - Thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }

    public function update_brand_product(Request $request, $brand_product_id){
        $this->AuthLogin();
        $data = $request->all();
        $brand =Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        //$brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request ->brand_product_name;
        // $data['brand_desc']= $request ->brand_product_desc;
        //DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Đã cập nhật Hãng - Thương hiệu sản phẩm');
        return Redirect::to('all-brand-product');
    }
    // End Function Admin Page


    public function show_brand_home($brand_id){
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();

        $cate_product =DB::table('tbl_category_product')
        ->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_product.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brand')
        ->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();


        return view('pages.brand.show_brand')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name)
        ->with('slider',$slider);
        
    }
}
