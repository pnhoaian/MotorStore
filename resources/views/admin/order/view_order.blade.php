@extends('admin_layout')
@section('admin_content')
<td>
  <a href="{{ URL::to('/manage-order') }}">
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
              style="padding-right: 5px;font-size:15px"></i>Quản lý đơn hàng</button>
  </a>
</td>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light"
                    style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                    <thead>
                        <tr>
                            <th style="text-align: center">Mã khách hàng</th>
                            <th style="text-align: center">Tên khách hàng</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td style="text-align: center">{{ $order_by_id->customer_id }}</td>
                            <td style="text-align: center">{{ $order_by_id->customer_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{-------------------*********************************************** Table 2 **********************************************--------------------}}
    <br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message2');
                if ($message) {
                    echo $message;
                    Session::put('message2', null);
                }
                ?>
                <table class="table table-striped b-t b-light"
                    style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                    <thead>
                        <tr>
                            <th style="width:160px; line-height:30px">Tên người nhận</th>
                            <th style="width:250px; line-height:30px; text-align: center">Địa chỉ nhận hàng</th>
                            <th style="width:120px; line-height:30px">Số điện thoại</th>
                            <th style="width:200px; line-height:30px; text-align: center">Email</th>
                            <th style="line-height:30px; text-align: center" >Phương thức thanh toán</th>
                            <th style="width:180px; line-height:30px">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td style="text-align: center" >{{ $order_by_id->shipping_name }}</td>
                            <td>{{ $order_by_id->shipping_address }}</td>
                            <td>{{ $order_by_id->shipping_phone }}</td>
                            <td>{{ $order_by_id->shipping_email }}</td>
                            <td style="text-align: center">
                                @if ($order_by_id->shipping_method_pay == 0)
                                    Chuyển khoản
                                @else
                                    Tiền mặt
                                @endif
                            </td>
                            <td>{{ $order_by_id->shipping_note }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


{{-------------------*********************************************** Table 3 **********************************************--------------------}}
<br>

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin đơn hàng
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light"
                style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                <thead>
                    <p style="line-height:30px; margin-left: 10px; font-size: 15px">Mã đơn hàng: {{ $order_by_id->Order_code }}</p>
                    
                    <tr>
                        <th style="width:160px; line-height:30px">Tên sản phẩm</th>
                        <th style="width:250px; line-height:30px;">Số lượng</th>
                        <th style="width:120px; line-height:30px">Giá</th>
                        <th style="width:200px; line-height:30px;">Khuyến mãi</th>
                        <th style="width:200px; line-height:30px;">Phí Ship</th>
                    </tr>
                </thead>
                <tr>
                    
                    <td>{{ $order_by_id->Product_name }}</td>
                    <td>{{ $order_by_id->Product_sales_quantity }}</td>
                    <td>{{ $order_by_id->Product_price }}</td>
                    <td>{{ $order_by_id->Product_coupon }}</td>
                    <td>{{ $order_by_id->Product_feeship }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
