@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Coupon - Mã giảm giá
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Hãng - Thương hiệu Đang Ẩn</option>
            <option value="1">Hãng - Thương hiệu Đang Hiện Thị</option>
          </select>
          <button class="btn btn-sm btn-default">Áp dụng</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Tìm Kiếm</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">

        <?php 
        $message = Session::get('message');
        if($message){
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message', null);
        }
        ?>

        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên chương trình</th>
              <th>Mã giảm giá</th>
              <th>Số lượng</th>
              <th>Điều kiện</th>
              <th>Giảm</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($coupon as $key => $cou)
              
            <tr>
                <td>{{ $cou->coupon_name }}</td>
                <td>{{ $cou->coupon_code }}</td>
                <td>{{ $cou->coupon_times }}</td>
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($cou->coupon_condition == 1){
                ?>
                   Giảm theo phần trăm
                <?php
                }else{
                ?>
                  Giảm theo phần trăm
                <?php 
                }
                ?>
              </span>
            </td>

            <td><span class="text-ellipsis">
                <?php
                if($cou->coupon_condition == 1){
                ?>
                    {{ $cou->coupon_number }} %
                <?php
                }else{
                ?>
                  {{ number_format($cou->coupon_number,0,',','.' ) }} VNĐ
                <?php 
                }
                ?>
              </span>
            </td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a onclick="return confirm('Xác nhận xóa Coupon này?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling" ui-toggle-class=""> 
                  <i class="fa fa-trash"></i></a>
              </td>
            </tr>

            @endforeach

          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>

@endsection