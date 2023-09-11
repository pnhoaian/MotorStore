@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Hãng - Thương hiệu
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
                        <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên Hãng - Thương hiệu</label>
                            <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Hãng - Thương hiệu">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Hãng - Thương hiệu</label>
                            <textarea style="resize:none" rows="6" name="brand_product_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn Hãng - Thương hiệu</option>
                                <option value="1">Hiện thị Hãng - Thương hiệu</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection