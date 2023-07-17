@extends('admin_layout');
@section('admin_content');

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Hãng - Thương hiệu
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
              <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>
              <th>Tên Hãng - Thương hiệu</th>
              <th>Trạng thái</th>
              {{-- <th>Ngày thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_brand_product as $key => $cate_pro)
              
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $cate_pro->brand_name }}</td>
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($cate_pro->brand_status == 0){
                ?>
                   <a href="{{URL::to('/active-brand-product/'.$cate_pro->brand_id)}}"><span class="fa-thump-styling-down fa fa-thumbs-down"></span></a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-brand-product/'.$cate_pro->brand_id)}}"><span class="fa-thump-styling fa fa-thumbs-up"></span></a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-brand-product/'.$cate_pro->brand_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                <a onclick="return confirm('Xác nhận xóa Hãng - Thương hiệu này?')" href="{{URL::to('/delete-brand-product/'.$cate_pro->brand_id)}}" class="active styling" ui-toggle-class=""> 
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