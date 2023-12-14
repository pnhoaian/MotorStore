@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-post') }}">
      <button class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
              style="padding-right: 5px;font-size:15px"></i>Thêm bài viết</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách Bài viết
      </div>
      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th>Tiêu đề Bài viết</th>
              <th>Mô tả ngắn</th>
              <th>Hình ảnh</th>
              <th>Danh mục</th>
              <th>Trạng thái</th>
              <th>Tác vụ</th>
              {{-- <th>Ngày thêm</th> --}}
             
            </tr>
          </thead>
          <tbody>
            @foreach ($all_post as $key => $post)
              
            <tr>
              <td>{{ $post->post_title}}</td>
              <td>{{ $post->post_desc}}</td>
              
              <td>
                  <img src="public/upload/post/{{$post->post_image}}" height="100px" width="200px">
              </td>
              <td>{{ $post->cate_post->cate_post_name }}</td>
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($post->post_status == 0){
                ?>
                   <a href="{{URL::to('/active-post/'.$post->post_id)}}"><span class="fa-thump-styling-down fa fa-thumbs-down"></span></a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-post/'.$post->post_id)}}"><span class="fa-thump-styling fa fa-thumbs-up"></span></a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                <a onclick="return confirm('Xác nhận xóa Bài viết này?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active styling" ui-toggle-class=""> 
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