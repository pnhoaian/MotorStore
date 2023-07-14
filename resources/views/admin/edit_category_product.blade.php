@extends('admin_layout');
@section('admin_content');

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Danh Mục
                </header>
                <?php 
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">
                    @foreach ($edit_category_product as $key => $edit_value )
                        
                    @endforeach

                    <div class="position-center">
                        <form role="form" action="{{URL::to('/edit-category-product')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $edit_value->catory_name }}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea value="{{ $edit_value->catory_desc }}" style="resize:none" rows="6" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Thêm mô tả"></textarea>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="edit" class="btn btn-info">Cập nhật</button>
                    </form>
                    </div>

@endsection