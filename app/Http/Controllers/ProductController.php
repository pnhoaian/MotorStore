<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Gallery;
use App\Models\Rating;
use App\Models\Customer;
use App\Models\Product;
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
        $data = $request->all();
        $data = $request->validate(
            [
                'product_name' => 'required|unique:tbl_product',   
                'product_desc' => 'required',
                'product_image' => 'required|image',
                'product_price' => 'required|numeric',
                'product_price_sale' => 'required|numeric',
                'product_quantity' => 'required|numeric',
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_status' => 'required',

                //    
            ],
            [
                'product_name.required' => 'Yêu cầu nhập tên sản phẩm',
                'product_name.unique' => 'Đã có sản phẩm trong hệ thống',

                'category_id.required' => 'Yêu cầu thêm danh mục sản phẩm ',
                'brand_id.required' => 'Yêu cầu thêm thương hiệu sản phẩm ',

                'product_desc.required' => 'Yêu cầu nhập mô tả sản phẩm ',

                'product_image.required' => 'Yêu cầu thêm hình ảnh cho sản phẩm ',
                'product_image.image' => 'Không phải định dạng file ảnh ',
                
                'product_price.numeric' => '"Giá sản phẩm" không phải định dạng số ',
                'product_price.required' => 'Yêu cầu nhập "GIÁ GỐC" cho sản phẩm ',

                'product_price_sale.required' => 'Yêu cầu nhập "GIÁ KHUYẾN MÃI" cho sản phẩm ',
                'product_price_sale.numeric' => '"Giá Khuyến mãi sản phẩm" không phải định dạng số ',

                'product_quantity.required' => 'Yêu cầu nhập số lượng sản phẩm ' ,
                'product_quantity.numeric' => '"Số lượng sản phẩm" không phải định dạng số ',

                'product_status.required' => 'Yêu cầu thêm trạng thái hiện thị sản phẩm ',
            ]
            );

        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        $product->product_desc = $data['product_desc'];
        $product->product_price = $data['product_price'];
        $product->product_price_sale = $data['product_price_sale'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_status = $data['product_status'];
        $get_image = $request->file('product_image');
        
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            $product->product_image = $new_image;
        
            Toastr::success('Thêm sản phẩm thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
            return Redirect::to('all-product');
        }
        //insert du lieu va tbl-product

        $product->save();
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
        
        $data = $request->validate(
            [
                'product_name' => 'required',   
                'product_desc' => 'required',
                'product_image' => 'image',
                'product_price' => 'required|numeric',
                'product_price_sale' => 'required|numeric',
                'product_quantity' => 'required|numeric',
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_status' => 'required',

                //    
            ],
            [
                'product_name.required' => 'Yêu cầu nhập tên sản phẩm',

                'category_id.required' => 'Yêu cầu thêm danh mục sản phẩm ',
                'brand_id.required' => 'Yêu cầu thêm thương hiệu sản phẩm ',

                'product_desc.required' => 'Yêu cầu nhập mô tả sản phẩm ',

                'product_image.image' => 'Không phải định dạng file ảnh ',
                
                'product_price.numeric' => '"Giá sản phẩm" không phải định dạng số ',
                'product_price.required' => 'Yêu cầu nhập "GIÁ GỐC" cho sản phẩm ',

                'product_price_sale.required' => 'Yêu cầu nhập "GIÁ KHUYẾN MÃI" cho sản phẩm ',
                'product_price_sale.numeric' => '"Giá Khuyến mãi sản phẩm" không phải định dạng số ',

                'product_quantity.required' => 'Yêu cầu nhập số lượng sản phẩm ' ,
                'product_quantity.numeric' => '"Số lượng sản phẩm" không phải định dạng số ',

                'product_status.required' => 'Yêu cầu thêm trạng thái hiện thị sản phẩm ',
            ]
            );

            $data = $request->all();
            $product = Product::find($product_id);
            $product->product_name = $data['product_name'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->product_desc = $data['product_desc'];
            $product->product_price = $data['product_price'];
            $product->product_price_sale = $data['product_price_sale'];
            $product->product_quantity = $data['product_quantity'];
            $product->product_status = $data['product_status'];
            $get_image = $request->file('product_image');
            if ($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload/product',$new_image);
                $data['product_image'] = $new_image;
                $product->product_image = $new_image;
            }
        $product->save();
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

        //gallery
        // $gallery = Gallery::where('product_id',$product_id)->get();

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->take(5)->get();


        //Đánh giá sp
        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
        // $customer_name = DB::table('tbl_customer')->where('customer_name',$customer_name)->get(1);

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
        ->with('all_ds',$all_ds)
        ->with('rating',$rating)
        // ->with('customer_name',$customer_name)
        ;
    }


    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
}
