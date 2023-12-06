<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\CategoryPostModel;
use Session;
use App\Models\Intro;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
session_start();

class introController extends Controller
{
    public function gioi_thieu(Request $request){
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        //slide
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();

        //
        $intr = Intro::where('intro_id',1)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // return view('admin.all_product')->with('all_product', $all_product);
        
        return view('pages.Intro.gioithieu')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product',$all_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('intr',$intr);
    }
    public function introduce(){
        $intr = Intro::where('intro_id',1)->get();
        return view('admin.intro.add_intro')->with(compact('intr'));
    }

    public function save_intro(Request $request){
        $data = $request->all();
        $intr = new Intro();
        $intr->intro_desc = $data['intro_desc'];
        $intr->save();
        // return redirect()->back()->with('Thêm thông tin thành công!');
        return redirect::to('introduce');
    }

    public function update_intro(Request $request, $intro_id){
        $data = $request->all();
        $intr = Intro::find($intro_id);
        $intr->intro_desc = $data['intro_desc'];
        $intr->save();
        //  return view('admin.intro.add_intro')->with('Cập nhật thông tin thành công!');
         return redirect::to('introduce');
        }

}
