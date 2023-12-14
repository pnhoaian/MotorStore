@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật Danh Mục
                </header>

                <div class="panel-body">
                    @foreach ($edit_category_product as $key => $edit_value )
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $edit_value->category_name }}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" rows="6" name="category_product_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả">{{ $edit_value->category_desc }}</textarea>
                        </div>
                        <div class="form-group">
                        <button type="submit" name="edit" class="btn btn-info">Cập nhật</button>
                    </form>
                    </div>

                    @endforeach
@endsection