@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa bài viết
                </header>
                <div class="panel-body">
                    <?php 
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" rows="3" name="post_title" value="{{ $post->post_title }}" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tiêu đề bài viết">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <textarea style="resize:none" rows="5" name="post_slug" class="form-control" placeholder="Thêm mô tả">{{ $post->post_slug }}</textarea>
                        </div>

                        <div class="form-group"></div>
                            <label for="exampleInputPassword1">Danh mục</label>
                            <select name="cate_post_id" class="form-control m-bot15">
                                @foreach ($cate_post as $key =>$cate) 
                                 <option {{ $cate->cate_post_id == $cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{ $cate->cate_post_name }}</option>
                                @endforeach   
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả ngắn</label>
                            <textarea style="resize:none"  rows="5" name="post_desc" class="form-control" placeholder="Thêm mô tả">{{ $post->post_desc }}"</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội bài viết</label>
                            <textarea style="resize:none" rows="8"  name="post_content" class="form-control" id="ckeditor" placeholder="Thêm mô tả">{{ $post->post_content }}"</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{ URL::to('public/upload/post/'.$post->post_image)}}" height="200px" width="350px">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                @if ($post->post_status==0)
                                    <option value="0">Ẩn bài viết</option>
                                    <option selected value="1">Hiện thị bài viết</option>
                                @else
                                    <option value="0">Ẩn bài viết</option>
                                    <option selected value="1">Hiện thị bài viết</option>
                                @endif
                                
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="update_post" class="btn btn-info">Cập nhật</button>
                    </form>
                    </div>

@endsection