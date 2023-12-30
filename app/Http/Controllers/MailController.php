<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\CategoryPostModel;
use Session;
use Mail;
use App\Models\Intro;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
use Toastr;
session_start();

class MailController extends Controller
{
    public function send_mail(){
        //send mail
        
       $to_name = "Hoài An Store";
       $to_email = "paminh0000@gmail.com";//send to this email
       
       //  $link_reset_pass = url('/update-new-pass?email='.$to_email.'$token'.$rand_id);

       //  $data = array("name"=>"Testing","body"=>$link_reset_pass); //body of mail.blade.php
       $data = array("name"=>"Testing","body"=>"Hello Anh Minh"); //body of mail.blade.php
    
       Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        //--send mail
   // return redirect('/trang-chu')->with('message','');
   }

    public function search1(Request $request){
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $keyword = $request->keywords_submit;
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        
        $search_product_count = $search_product->count();
        return view('pages.product.search')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('search_product',$search_product)
        ->with('search_product_count',$search_product_count);
    }
}
