<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\CatePost;
use App\Models\Post;
session_start();

class PostController extends Controller
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

    public function add_post(){
        $this->AuthLogin();
        $cate_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        return view('admin.post.add_post')->with(compact('cate_post'));
    }

    public function all_post(){
        $this->AuthLogin();
        // $all_post = DB::table('tbl_post')->get(); 
        $all_post = Post::with('cate_post')->OrderBy('post_id')->paginate(10);
        
        return view('admin.post.all_post')->with(compact('all_post'));
        //return view('admin.all_post');
    }

    public function save_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post();
        $post ->post_title = $data['post_title'];
        $post ->post_desc = $data['post_desc'];
        $post ->post_content = $data['post_content'];
        $post ->post_slug = $data['post_slug'];
        $post ->cate_post_id = $data['cate_post_id'];
        $post ->post_status = $data['post_status'];
        $get_image = $request->file('post_image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/post',$new_image);
            $data['post_image'] = $new_image;
            $post->post_image = $new_image;
            $post->save();
            //insert du lieu va tbl-post
        // DB::table('tbl_post')->insert($data);
        Session::put('message', 'Thêm bài viết thành công!');
        return Redirect::to('all-post');
         }
        // else{
        //     Session::put('message', 'Chưa thêm ảnh bài viết');
        //     return Redirect::to('add-post');
        //  }
        
    }

    public function edit_post($post_id){
        $this->AuthLogin();
        $cate_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit_post')->with(compact('post','cate_post'));
    }

    public function delete_post($post_id){
        $this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;
        
        if($post_image){
            $path = ('public/upload/post'.$post_image);
            unlink($path);
        }
        $post->delete();
        Session::put('message','Xóa bài viết thành công');
        return Redirect::to('/all-post');
    }

    public function update_post(Request $request, $post_id){
        $this->AuthLogin();
        $data = $request->all();
        $post = Post::find($post_id);
        $post ->post_title = $data['post_title'];
        $post ->post_desc = $data['post_desc'];
        $post ->post_content = $data['post_content'];
        $post ->post_slug = $data['post_slug'];
        $post ->cate_post_id = $data['cate_post_id'];
        $post ->post_status = $data['post_status'];
        $get_image = $request->file('post_image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/post',$new_image);
            $post->post_image = $new_image;
         }
        
         $post->save();
         //insert du lieu va tbl-post
        // DB::table('tbl_post')->insert($data);
        Session::put('message', 'Cập nhật bài viết thành công!');
        return Redirect::to('all-post');
    }
}
