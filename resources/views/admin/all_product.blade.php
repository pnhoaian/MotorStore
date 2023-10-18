@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Sản phẩm
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Sản phẩm Đang Ẩn</option>
            <option value="1">Sản phẩm Đang Hiện Thị</option>
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
              <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>
              <th>Tên Sản phẩm</th>
              <th>Giá</th>
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
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $pro->product_name }}</td>
              <td>{{ $pro->product_price }}</td>
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