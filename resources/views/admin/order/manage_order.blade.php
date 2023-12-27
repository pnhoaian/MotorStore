@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách đơn hàng
      </div>
      
      <div class="table-responsive" >

        {!! Toastr::message() !!}

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã đơn hàng</th>
              <th>Thời gian đặt</th>
              <th>Tình trạng đơn hàng</th>
              <th>Tác vụ</th>
              {{-- <th>Ngày thêm</th> --}}
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($order as $key => $ord)
            @php
                $i++;
            @endphp
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $ord->order_code }}</td>
              <td>{{ $ord->create_at }}</td>
              
              <td><span class="text-ellipsis">
                <?php
                if($ord->order_status == 0){
                ?>
                   <a href="{{URL::to('/active-category-product/'.$ord->order_id)}}">
                    <button style="width: 110px;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #ffffff;background: #00000026;border-radius:5px;background: 	#33CC33 !important;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                    class="button-chuyen" role="button">Đã xử lý</button>
                  </a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-category-product/'.$ord->order_id)}}">
                    {{-- <span class="fa-thump-styling fa fa-thumbs-up"></span> --}}
                    <button style="width: 110px;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #ffffff;background: #00000026;border-radius:5px;background:#CC0033 !important;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                    class="button-chuyen" role="button">Chưa xử lý</button>
                  </a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-eye text-success text-active"></i>
                <a onclick="return confirm('Xác nhận xóa Đơn Hàng này?')" href="{{URL::to('/delete-order/'.$ord->order_id)}}" class="active styling" ui-toggle-class=""> 
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