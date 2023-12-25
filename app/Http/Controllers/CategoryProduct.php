<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use Toastr;

use App\Models\CatePost;
use App\Models\Product;
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
        return view('admin.categoryproduct.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get(); 
        return view('admin.categoryproduct.all_category_product')->with('all_category_product', $all_category_product);
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
        Toastr::success('Thêm danh mục sản phẩm thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
        //return view('admin.save_category_product');
    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' =>1]);
        Toastr::success('Đã hiện thị danh mục sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }

    public function inactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' =>0]);
        Toastr::success('Đã ẩn danh mục sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        return view('admin.categoryproduct.edit_category_product')->with('edit_category_product', $all_category_product);
        //return view('admin.all_category_product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Toastr::warning('Xóa danh mục sản phẩm thành công','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }

    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request ->category_product_name;
        $data['category_desc']= $request ->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Toastr::success('Đã cập nhật danh mục sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }
        //End Function Admin

    public function show_category_home(Request $request,$category_id){
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $max_price_range = $max_price + 500000;

    //     if(isset($_GET['sort_by'])){
    //         $sort_by = $_GET['sort_by'];

    //         if($sort_by =='giam_dan'){
    //             $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','desc')
    //             ->paginate(6)->appends(request()->querry());
    //         }elseif($sort_by =='tang_dan'){
    //             $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','asc')
    //             ->paginate(6)->appends(request()->querry());
    //         }elseif($sort_by =='kytu_az'){
    //             $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','desc')
    //             ->paginate(6)->appends(request()->querry());
    //         }elseif($sort_by =='kytu_za'){
    //             $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','asc')
    //             ->paginate(6)->appends(request()->querry());
    //         }

    //     }elseif(isset($_GET['start_price']) && $_GET['end_price']){
    //             $min_price = $_GET['start_price'];    
    //             $max_price = $_GET['end_price'];
    //             $category_by_id = Product::with('category')->whereBetween('product_price',[$min_price,$max_price])->orderBy('product_id','asc')
    //                         ->paginate(6);
    // }else{
    //     $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id','desc')
    //             ->paginate(6);
    // }

        
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$category_id)->get();
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();

        return view('pages.category.show_category')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name)
        ->with('category_post',$category_post)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('min_price',$min_price)
        ->with('max_price',$max_price)
        ->with('max_price_range',$max_price_range);
    }

}
