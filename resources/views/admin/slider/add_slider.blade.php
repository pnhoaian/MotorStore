@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Slide - Banner
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
                        <form role="form" action="{{URL::to('/insert-slider')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Slide - Banner</label>
                                <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Slide - Banner">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh</label>
                                <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Hình ảnh Slide - Banner">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả Slide - Banner</label>
                                <textarea style="resize:none" rows="6" name="slider_desc" class="form-control" id="exampleInputEmail1" placeholder="Thêm mô tả"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Loại Banner</label>
                                <select name="slider_type" class="form-control input-sm m-bot15">
                                    <option value="0" selected>Banner Lớn </option>
                                    <option value="1">Banner Nhỏ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hiện thị</label>
                                <select name="slider_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn Slide - Banner</option>
                                    <option value="1" selected>Hiện thị Slide - Banner</option>
                                </select>
                            </div>

                            <div class="form-group">
                            <button type="submit" name="add_slider" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

@endsection