@extends('welcome')
@section('content')

@section('footer')
	@include("pages.include.footer")
@endsection()

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 style="text-align: center">LỊCH SỬ ĐẶT HÀNG</h3>
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
            @foreach ($getorder as $key => $ord)
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
                    <span style="width: 110px;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #33CC33;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                     >Đã xử lý</span></a>

                <?php
                }
                  elseif($ord->order_status == 1){
                ?>
                    <span style="width: 110px;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #CC0033;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                     >Chưa xử lý</span></a>                 
                <?php 

                }else{
                ?>
                  
                    <span style="width: 110px;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #999999;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                     >Khách đã hủy đơn</span>
                  </a>
                 
                <?php 

                }
                ?>
              </span></td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td style="margin-left: 70px">
                <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active styling" ui-toggle-class="">
                  
                    <i class="fa fa-eye text-success text-active" style="margin-left: 10px;" ></i>
              </td>
            </tr>

            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection