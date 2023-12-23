<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\CatePost;
use Toastr;
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
        return view('admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        return view('admin.product.all_product')->with('all_product', $all_product);
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
        $data['product_price_sale']= $request ->product_price_sale;
        $data['product_quantity']= $request ->product_quantity;
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
            Toastr::success('Thêm sản phẩm thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
            return Redirect::to('all-product');
        }
        //insert du lieu va tbl-product
        $data['product_image']='';
        DB::table('tbl_product')->insert($data);
        Toastr::success('Thêm sản phẩm thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-product');
        //return view('admin.save_product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' =>1]);
        Toastr::success('Đã hiện thị sản phẩm!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-product');
    }

    public function inactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' =>0]);
        Toastr::success('Đã ẩn sản phẩm!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product =DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        return view('admin.product.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        //return view('admin.all_product');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Toastr::success('Đã xóa sản phẩm!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
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
        $data['product_price_sale']= $request ->product_price_sale;
        $data['product_quantity']= $request ->product_quantity;
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
        Toastr::success('Đã cập nhật sản phẩm!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
            return Redirect::to('all-product');
    }
    //End Admin Page

    public function detail_product($product_id){
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(5)->get();

        $all_sdp = DB::table('tbl_product')->where('product_status','1')->where('category_id','9')->orderby('product_id','desc')->limit(5)->get();
        $all_ds = DB::table('tbl_product')->where('product_status','1')->where('category_id','8')->orderby('product_id','desc')->limit(5)->get();
        //test
        $sdp =DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)
        ->get();

        $detail_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($detail_product as $key =>$value)
        {$category_id = $value->category_id;}

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->take(5)->get();

        return view('pages.product.show_detail')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('product_detail', $detail_product)
        ->with('related_pro', $related_product)
        ->with('slider',$slider)
        ->with('category_post',$category_post)
        ->with('slidermini',$slidermini)
        ->with('sdp',$sdp)
        ->with('all_product',$all_product)
        ->with('all_sdp',$all_sdp)
        ->with('all_ds',$all_ds);
    }
}
