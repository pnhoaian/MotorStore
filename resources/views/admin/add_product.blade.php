@extends('admin_layout');
@section('admin_content');

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sản phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="POST">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên Sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                            <select name="product_status" class="form-control m-bot15">
                                <option value="0">Ẩn Sản phẩm</option>
                                <option value="1">Hiện thị Sản phẩm</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hãng - Thương hiệu</label>
                            <select name="product_status" class="form-control m-bot15">
                                <option value="0">Ẩn Sản phẩm</option>
                                <option value="1">Hiện thị Sản phẩm</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Sản phẩm</label>
                            <textarea style="resize:none" rows="6" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Nhập giá Sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="product_status" class="form-control m-bot15">
                                <option value="0">Ẩn Sản phẩm</option>
                                <option value="1">Hiện thị Sản phẩm</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection