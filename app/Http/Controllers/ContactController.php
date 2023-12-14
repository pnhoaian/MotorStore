<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\CategoryPostModel;
use Session;
use App\Models\Contact;
use App\Models\Slider;
use App\Models\CatePost;
use Toastr;
use Illuminate\Support\Facades\Redirect;
session_start();

class ContactController extends Controller
{
    public function lien_he(Request $request){
        //slide
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();

        //
        $contact = Contact::where('info_id',1)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // return view('admin.all_product')->with('all_product', $all_product);
        
        return view('pages.contact.contact')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product',$all_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('contact',$contact);
        
    }
    public function information(){
        $contact = Contact::where('info_id',1)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }

    public function update_info(Request $request, $info_id){
        $data = $request->all();
        $contact = Contact::find($info_id);
        $contact->info_address = $data['info_address'];
        $contact->info_number = $data['info_number'];
        $contact->info_email = $data['info_email'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->info_map = $data['info_map'];
        $contact->save();
        return redirect()->back()->with('Cập nhật thông tin thành công!');
    }

    public function save_information(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact->info_address = $data['info_address'];
        $contact->info_number = $data['info_number'];
        $contact->info_email = $data['info_email'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->info_map = $data['info_map'];
        $contact->save();
        return redirect()->back()->with('Thêm thông tin thành công!');
    }

}
