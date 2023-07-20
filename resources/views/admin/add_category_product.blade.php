@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Danh Mục
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
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" rows="6" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hiện thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn Danh Mục</option>
                                <option value="1">Hiện thị Danh Mục</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection