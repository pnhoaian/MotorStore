@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-product') }}">
      <button class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
              style="padding-right: 5px;font-size:15px"></i>Thêm sản phẩm</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Sản phẩm
      </div>
      
      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th>Tên Sản phẩm</th>
              <th>Giá gốc</th>
              <th>Giá khuyến mãi</th>
              <th>Hình ảnh</th>
              <th>Danh Mục</th>
              <th>Thương Hiệu</th>
              <th>Trạng thái</th>
              {{-- <th>Ngày thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_product as $key => $pro)
              
            <tr>
              <td>{{ $pro->product_name }}</td>
              <td>{{ $pro->product_price }}</td>
              <td> <?php
                if($pro->product_price_sale == 0){
                ?>
                   <span >không có</span>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <span>{{ $pro->product_price_sale}}</span>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>
              <td><img src=" public/upload/product/{{ $pro->product_image }}" height="100px" width="100px"></td>
              <td>{{ $pro->category_name }}</td>
              <td>{{ $pro->brand_name }}</td>

              {{---- status  ----}}
              <td><span class="text-ellipsis">
                <?php
                if($pro->product_status == 0){
                ?>
                   <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thump-styling-down fa fa-thumbs-down"></span></a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-product/'.$pro->product_id)}}"><span class="fa-thump-styling fa fa-thumbs-up"></span></a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              <td>
                <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                  
                <a onclick="return confirm('Xác nhận xóa Sản phẩm này?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling" ui-toggle-class=""> 
                  <i class="fa fa-trash"></i></a>
              </td>
            </tr>

            @endforeach

          </tbody>
        </table>
      </div>
    
    </div>
  </div>

@endsection