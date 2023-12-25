@extends('admin_layout')
@section('admin_content')

    <div class="row">
        <h3 class="title_ThongKe" style="text-align: center; margin-bottom: 10px">Thống Kê Doanh Số - Đơn Hàng</h3>
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
        <div class="col-md-12">
            <div id="myfirstchart" style="height: 300px;">

            </div>
        </div>

    </div>
{{--  ************* End Thống kê phần đầu ************--}}

    <div>



    </div>



<div>

</div>
@endsection