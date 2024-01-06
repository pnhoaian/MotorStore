@extends('admin_layout')
@section('admin_content')

    <div class="row">
            <h2 class="title_ThongKe" style="text-align: center; margin-bottom: 10px">THỐNG KÊ DOANH SỐ BÁN HÀNG</h2>
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
        
</div>


        <div class="col-md-12">
            <div id="myfirstchart" style="height: 300px;"></div>
        </div>

<div style="margin-top: 20px ;">
    <div class="col-md-12 col-xs-12">
        <h3 style="text-align: center">THỐNG KÊ TỔNG QUÁT</h3>
        <div id="donut"></div>
    </div>
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




<div style="margin-top: 20px ;">
    <div class="col-md-4 col-xs-12">
        <h3 style="text-align: center">THỐNG KÊ BÀI VIẾT</h3>
        <p style="text-align: center">Tên bài viết | Số lượt xem</p>
            <ol>
                @foreach ($post_vieww as $key=>$post)
                    <li>
                        <a target="_blank" href="{{ URL('/bai-viet/'.$post->post_id) }}" style="color: white;">{{ $post->post_title }} | <span style="color: black">{{ $post->post_view }}</span></a>
                    </li>
                @endforeach
            </ol>
    </div>

    <div class="col-md-4 col-xs-12">
        <h3 style="text-align: center">THỐNG KÊ SẢN PHẨM</h3>
        <p style="text-align: center">Tên sản phẩm | Số lượt xem</p>
        @foreach ($product_vieww as $key=>$pro)
        <li>
            <a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: white;"> {{ $pro->product_name }} | <span style="color: black">{{ $pro->product_view }}</span></a>
        </li>
    @endforeach
    </div>

    <div class="col-md-4 col-xs-12">
        <h3 style="text-align: center">THỐNG KÊ SẢN PHẨM BÁN CHẠY </h3>
        <p style="text-align: center">Tên sản phẩm | Số lượt bán</p>
        @foreach ($product_soldd as $key=>$pro)
        <li>
            <a target="_blank" href="{{ URL('/chi-tiet-san-pham/'.$pro->product_id) }}" style="color: white;"> {{ $pro->product_name }} | <span style="color: black">{{ $pro->product_sold }}</span></a>
        </li>
    @endforeach
    </div>
    

</div>



@endsection