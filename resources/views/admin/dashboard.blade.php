@extends('admin_layout')
@section('admin_content')

    <div class="row">
            <h2 class="title_ThongKe" style="text-align: center; margin-bottom: 10px;color: #EE3E38;">THỐNG KÊ DOANH SỐ BÁN HÀNG</h2>
            <form autocomplete="off">
                @csrf
                <div class="col-md-2" style="margin-left: 30px">
                    <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                    <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc Kết quả">
                </div>
                <div class="col-md-2" style="margin-left: 30px">
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                </div>

                <div class="col-md-2">
                    <p>
                        Lọc theo: 
                        <select class="dashboard-filter form-control">
                            <option>----- Chọn -----</option>
                            <option value="7ngay">7 Ngày qua</option>
                            <option value="thangtruoc">Tháng trước</option>
                            <option value="thangnay">Tháng này</option>
                            <option value="365ngayqua">365 Ngày qua</option>
                        </select>
                    </p>
            </form>
        </div>

                {{-- 
        <p style="text-align: center">Tên bài viết | Số lượt xem</p>
            <ol>
                
                    <li>
                        <a target="_blank" href="{{ URL('/bai-viet/'.$post->post_id) }}" style="color: #337ab7;white;"> | <span style="color: black"></span></a>
                    </li>
               
            </ol> --}}
    

    <div class="col-md-4 col-xs-12">
        
        <p style="text-align: center"> Ngày bán</p>
            @foreach ($sldonngay as $key => $ngayban)
                <p>Ngày bán: {{ $ngayban->order_date }}</p>
                <p>Mã đơn hàng: {{ $ngayban->order_code }}</p>
                <p>Tổng số đơn: {{ $demdon }}</p>
            @endforeach


            <p style="text-align: center"> Số lượng bán được</p>
            @foreach ($slbann as $key=> $sl)
            <p>Số lượng bán được: {{ $dem }}</p>
            @endforeach
    </div>
        
</div>


        <div class="col-md-12">
            <div id="myfirstchart" style="height: 300px;"></div>
        </div>

<div style="margin-top: 20px ;">
    <div class="col-md-12 col-xs-12">
        <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ TỔNG QUÁT</h3>
        <div id="donut" style="background:blanchedalmond;border-radius: 15px "></div>
    </div>
</div>
<div  style="background:#fff;display: table-row;
z-index: 999;
background: #fff;" >
    <li class="a" style="list-style-type: none;width:100%">&nbsp</li> 
 </div>


        
        
    
    {{--  ************* Thống kê truy cập Admin ************--}}
{{-- <div class="row">
                <div class="col-md-12 ">
                    <style type="text/css">
                        table.table.table-bordered.table-dark {
                            background: #FF4040;
                        }
    
                        table.table.table-bordered.table-dark tr th {
                            color: #fff;
                            text-align: center;
                        }
                        table.table.table-bordered.table-dark td {
                            color: #fff;
                            text-align: center;
                        }
                    </style>
                    <h3 class="title_ThongKe" style="text-align: center; margin-bottom: 10px">THỐNG KÊ ADMIN TRUY CẬP</h3>
                    <table class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Đang online</th>
                                <th scope="col">Tổng tháng trước</th>
                                <th scope="col">Tổng tháng này</th>
                                <th scope="col">Tổng một năm</th>
                                <th scope="col">Tổng truy cập</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <tr>
                                <td>{{ $visitor_count }}</td>
                                <td>{{ $visitor_last_month_count }}</td>
                                <td>{{ $visitor_this_month_count }}</td>
                                <td>{{ $visitor_year_count }}</td>
                                <td>{{ $visitors_total }}</td>
                            </tr>                    
                        </tbody>
                    </table>
                </div>
</div> --}}




<div style="margin-top: 10px ;">
    <div class="col-md-12 col-xs-12" style="background: blanchedalmond;padding-top: 10px;padding-bottom: 10px;border-radius: 15px;">
        <table class="table">
            <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ BÀI VIẾT</h3>
            <thead class="thead-light">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên bài viết</th>
                <th scope="col">Số lượt xem</th>
              </tr>
            </thead>
            <tbody>
                    @php
                        $i=0;
                    @endphp
                @foreach ($post_vieww as $key=>$post)
                    @php
                        $i++;  
                    @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td><a target="_blank" href="{{ URL('/bai-viet/'.$post->post_id) }}" style="color: #337ab7;">{{ $post->post_title }}</a></td>
                        <td style="text-align: center;">{{ $post->post_view }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <div  style="background:#fff;display: table-row;
    z-index: 999;
    background: #fff;" >
        <li class="a" style="list-style-type: none;width:100%">&nbsp</li> 
     </div>
     


<div style="margin-top: 10px;">
    <div class="col-md-12 col-xs-12" style="background: blanchedalmond;padding-top: 10px;padding-bottom: 10px;border-radius: 15px;">
        <table class="table">
            <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ SẢN PHẨM</h3>
            <thead class="thead-light">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượt xem</th>
              </tr>
            </thead>
            <tbody>
                    @php
                        $i=0;
                    @endphp
                @foreach ($product_vieww as $key=>$pro)
                    @php
                        $i++;  
                    @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td><a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: #337ab7;white;">{{ $pro->product_name }}</a></td>
                        <td>{{ $pro->product_view }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
</div>
<div  style="background:#fff;display: table-row;
z-index: 999;
background: #fff;" >
    <li class="a" style="list-style-type: none;width:100%">&nbsp</li> 
 </div>



<div style="margin-top: 10px;">
    <div class="col-md-12 col-xs-12" style="background: blanchedalmond;padding-top: 10px;padding-bottom: 10px;border-radius: 15px;">
        <table class="table">
            <h3 style="text-align: center;color: #EE3E38;">THỐNG KÊ SẢN PHẨM BÁN CHẠY </h3>
            <thead class="thead-light">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượt bán</th>
              </tr>
            </thead>
            <tbody>
                    @php
                        $i=0;
                    @endphp
                @foreach ($product_soldd as $key=>$pro)
                    @php
                        $i++;  
                    @endphp
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td><a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: #337ab7;white;">{{ $pro->product_name }}</a></td>
                        <td style="text-align: center;">{{ $pro->product_sold }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>
<br>
        {{-- 
        <p style="text-align: center">Tên bài viết | Số lượt xem</p>
            <ol>
                
                    <li>
                        <a target="_blank" href="{{ URL('/bai-viet/'.$post->post_id) }}" style="color: #337ab7;white;"> | <span style="color: black"></span></a>
                    </li>
               
            </ol> --}}
    

    {{-- <div class="col-md-4 col-xs-12">
        
        <p style="text-align: center"> | Số lượt xem</p>
        <ol>
            @foreach ($product_vieww as $key=>$pro)
                <li style="color: #337ab7;">
                    <a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: #337ab7;;"> {{ $pro->product_name }} | <span style="color: black">{{ $pro->product_view }}</span></a>
                </li>
            @endforeach
        </ol>
    </div> --}}


    {{-- <div class="col-md-4 col-xs-12">
        <h3 style="text-align: center">THỐNG KÊ SẢN PHẨM BÁN CHẠY </h3>
        <p style="text-align: center">Tên sản phẩm | Số lượt bán</p>
        <ol>
            @foreach ($product_soldd as $key=>$pro)
                <li style="color: #337ab7;">
                    <a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: #337ab7;;">  | <span style="color: black">{{ $pro->product_sold }}</span></a>
                </li>
            @endforeach
        </ol>
    </div> --}}
    

</div>



@endsection