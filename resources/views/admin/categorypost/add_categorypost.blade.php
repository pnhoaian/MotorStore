@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục bài viết
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
                        <form role="form" action="{{URL::to('/save-category-post')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" name="cate_post_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tên thư mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                            <textarea style="resize:none" rows="6" name="cate_post_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <textarea style="resize:none" rows="6" name="cate_post_slug" class="form-control" id="convert_slug" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn danh mục bài viết</option>
                                <option value="1">Hiện thị danh mục bài viết</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_post_cate" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection