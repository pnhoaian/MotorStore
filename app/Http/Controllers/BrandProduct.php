<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\CatePost;
use Toastr;
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
        // $this->AuthLogin();
        // $data = $request->all();
        // $brand = new Brand();
        // $brand->brand_name = $data['brand_product_name'];
        // $brand->brand_desc = $data['brand_product_desc'];
        // $brand->brand_status = $data['brand_product_status'];
        // $brand->brand_image = $data['brand_image'];
        // $get_image = $request->file('brand_image');
        // $brand->save();

        // if($get_image){
        //     //lấy tên file hình ảnh
        //     $get_name_image = $get_image->getClientOriginalName();
        //     $name_image = current(explode('.',$get_name_image));
        //     $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        //     $get_image->move('public/upload/brand',$new_image);
        //     $data['brand_image']=$new_image;
        //     DB::table('tbl_brand')->insert($data);
        //     $request->session()->put('message', 'Thêm Hãng - thương hiệu thành công!');
        //     return Redirect::to('all-brand-product');
        // }
        // //insert du lieu va tbl-product
        // $data['brand_image']='';
        // DB::table('tbl_brand')->insert($data);
        // $request->session()->put('message', 'Thêm Hãng - thương hiệu thành công!');
        // return Redirect::to('all-brand-product');

        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $get_image = $request->file('brand_image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/brand',$new_image);
            $data['brand_image'] = $new_image;
            $brand->brand_image = $new_image;
        }
        $thuonghieu = Brand::where('brand_name','=',$data['brand_product_name'])->get();
        if($thuonghieu){
            $count_thuonghieu = $thuonghieu->count();
            if($count_thuonghieu==0){
                $brand->save();
                
                 return Redirect::to('all-brand-product');
            }
            else{
               
                return Redirect::to('all-brand-product');
            }
        }

        
        Toastr::success('Thêm thương hiệu sản phẩm thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-brand-product');

    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' =>1]);
        Toastr::success('Đã hiện thị thương hiệu','Thông báo !');
        return Redirect::to('all-brand-product');
    }

    public function inactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' =>0]);
        Toastr::success('Đã ẩn Hãng - Thương hiệu sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
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
        Toastr::warning('Xóa thương hiệu sản phẩm thành công','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-brand-product');
    }

    public function update_brand_product(Request $request, $brand_product_id){
        // $this->AuthLogin();
        // $data = $request->all();
        // $brand =Brand::find($brand_product_id);
        // $brand->brand_name = $data['brand_product_name'];
        // $brand->brand_desc = $data['brand_product_desc'];

        // $get_image = $request->file('brand_image');
        // if ($get_image){
        //     $get_name_image = $get_image->getClientOriginalName();
        //     $name_image = current(explode('.', $get_name_image));
        //     $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        //     $get_image->move('public/upload/brand',$new_image);
        //     $data['brand_image'] = $new_image;
        //     $brand->brand_image = $new_image;
        // }
        // $thuonghieu = Brand::where('brand_name','=',$data['brand_product_name'])->get();
        // if($thuonghieu){
        //     $count_thuonghieu = $thuonghieu->count();
        //     if($count_thuonghieu==0){
        //         $brand->save();
                
        //          return Redirect::to('all-brand-product');
        //     }
        //     else{
               
        //         return Redirect::to('all-brand-product');
        //     }
        // }


        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];

        $get_image = $request->file('brand_image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/brand',$new_image);
            $data['brand_image'] = $new_image;
            $brand->brand_image = $new_image;
        }


        $brand->save();
        Toastr::success('Đã cập nhật thương hiệu sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-brand-product');








        $get_image = $request->file('brand_image');
        if($get_image){
            //lấy tên file hình ảnh
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/brand',$new_image);
            $data['brand_image']=$new_image;
            
        }
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
            $request->session()->put('message', 'Cập nhật Hãng - Thương hiệu thành công!', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
            return Redirect::to('all-brand-product');
        //$brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request ->brand_product_name;
        // $data['brand_desc']= $request ->brand_product_desc;
        //DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Toastr::success('Đã cập nhật thương hiệu sản phẩm','Thông báo !');
        return Redirect::to('all-brand-product');
    }
    // End Function Admin Page


    public function show_brand_home($brand_id){
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $cate_product =DB::table('tbl_category_product')
        ->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')
        ->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_product.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brand')
        ->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();


        return view('pages.brand.show_brand')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name)
        ->with('category_post',$category_post)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini);
        
    }
}
