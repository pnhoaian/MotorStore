@extends('admin_layout')
@section('admin_content')

<td>
    <a href="{{ URL::to('/all-post') }}">
        <button class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
                style="padding-right: 5px;font-size:15px"></i>Quản lý bài viết</button>
    </a>
</td>

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm bài viết
                </header>
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-post')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" rows="3" name="post_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tiêu đề bài viết">
                        </div>

                        <div class="form-group"></div>
                            <label for="exampleInputPassword1">Danh mục</label>
                            <select name="cate_post_id" class="form-control m-bot15">
                                @foreach ($cate_post as $key =>$cate) 
                                 <option value="{{ $cate->cate_post_id}}">{{ $cate->cate_post_name }}</option>
                                @endforeach   
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả ngắn</label>
                            <textarea style="resize:none" rows="5" name="post_desc" class="form-control" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội bài viết</label>
                            <textarea style="resize:none" rows="8" name="post_content" class="form-control" id="ckeditor" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn bài viết</option>
                                <option selected value="1">Hiện thị bài viết</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_post" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection