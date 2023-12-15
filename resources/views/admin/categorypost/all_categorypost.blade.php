@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-category-post') }}">
      <button style="width: fit-content;
      padding: 0.5em 1em;text-align: center;float: inherit;
      margin: 0em auto;
      color: #ffffff;
      background: #00000026;
      border-radius:5px;
      background: 	#CC0033 !important;
      margin-bottom: 10px;
      font-family: -apple-system, system-ui, BlinkMacSystemFont;
      font-weight: 700;
      " class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
              style="padding-right: 5px;font-size:15px"></i>Quản lý danh mục bài viết</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Danh mục bài viết
      </div>

      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th>Tên Danh mục bài viết</th>
              <th>Trạng thái</th>
              {{-- <th>Ngày thêm</th> --}}
              <th> Tác vụ</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_category_post as $key => $cate_post)
              
            <tr>
              <td>{{ $cate_post->cate_post_name }}</td>
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($cate_post->cate_post_status == 0){
                ?>
                   <a href="{{URL::to('/active-category-post/'.$cate_post->cate_post_id)}}"><span class="fa-thump-styling-down fa fa-thumbs-down"></span></a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-category-post/'.$cate_post->cate_post_id)}}"><span class="fa-thump-styling fa fa-thumbs-up"></span></a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>





              </span></td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-category-post/'.$cate_post->cate_post_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                <a onclick="return confirm('Xác nhận xóa Danh mục này?')" href="{{URL::to('/delete-category-post/'.$cate_post->cate_post_id)}}" class="active styling" ui-toggle-class=""> 
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