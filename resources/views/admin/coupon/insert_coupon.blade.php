@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Coupon mới
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
                        <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="POST">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên chương trình Giảm Giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã Giảm Giá</label>
                            <input type="text" name="coupon_code" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng Coupon</label>
                            <input type="text" name="coupon_times" class="form-control" id="name">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Chương trình giảm giá</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">--------Chọn--------</option>
                                <option value="1">Giảm theo phần trăm trên hóa đơn</option>
                                <option value="2">Giảm tiền trực tiếp trên hóa đơn</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số tiền hoặc % giảm giá</label>
                            <input type="text" name="coupon_number" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

@endsection