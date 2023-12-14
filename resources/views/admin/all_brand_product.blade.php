@extends('admin_layout')
@section('admin_content')
<td>
  <a href="{{ URL::to('/add-brand-product') }}">
      <button class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
              style="padding-right: 5px;font-size:15px"></i>Thêm thương hiệu sản phẩm</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Hãng - Thương hiệu
      </div>
      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th>Tên Hãng - Thương hiệu</th>
              <th>Hình ảnh</th>
              <th>Trạng thái</th>
              <th>Tác vụ</th>
              {{-- <th>Ngày thêm</th> --}}

            </tr>
          </thead>
          <tbody>
            @foreach ($all_brand_product as $key => $brand_pro)
              
            <tr>
              <td>{{ $brand_pro->brand_name}}</td>
              <td>
                  <img src="public/upload/brand/{{$brand_pro->brand_image}}" height="40px" width="180px">
              </td>
              
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($brand_pro->brand_status == 0){
                ?>
                   <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"><span class="fa-thump-styling-down fa fa-thumbs-down"></span></a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-brand-product/'.$brand_pro->brand_id)}}"><span class="fa-thump-styling fa fa-thumbs-up"></span></a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                <a onclick="return confirm('Xác nhận xóa Hãng - Thương hiệu này?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="active styling" ui-toggle-class=""> 
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