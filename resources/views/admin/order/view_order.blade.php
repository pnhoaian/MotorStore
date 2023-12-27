@extends('admin_layout')
@section('admin_content')
<td>
  <a href="{{ URL::to('/manage-order') }}">
      <button style="width: fit-content;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #ffffff;background: #00000026;border-radius:5px;background: 	#CC0033 !important;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
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
                            <th style="text-align: center">Số điện thoại</th>
                            <th style="text-align: center">Email</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td style="text-align: center">{{ $customer->customer_id }}</td>
                            <td style="text-align: center">{{ $customer->customer_name }}</td>
                            <td style="text-align: center">{{ $customer->customer_phone }}</td>
                            <td style="text-align: center">{{ $customer->customer_email }}</td>
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
                            <td style="text-align: center" >{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>{{ $shipping->shipping_email }}</td>

                            <td style="text-align: center">
                                @if ($shipping->shipping_method_pay == 0)
                                    Chuyển khoản
                                @else
                                    Tiền mặt
                                @endif
                            </td>

                            <td>{{ $shipping->shipping_note }}</td>
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
                    
                    
                    <tr>
                        <th style="width:160px; line-height:30px">STT</th>
                        <th style="width:160px; line-height:30px">Tên sản phẩm</th>
                        <th style="width:250px; line-height:30px;">Số lượng</th>
                        <th style="width:120px; line-height:30px">Giá</th>
                        <th style="width:200px; line-height:30px;">Tổng tiền</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @php
                        $i=0;
                        $total = 0;
                    @endphp
                    @foreach ($order_details as $details)
                        @php
                            $i++;
                            $subtotal = $details->Product_price * $details->Product_sales_quantity;
                            $total+=$subtotal;
                        @endphp

                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $details->Product_name }}</td>
                    <td>{{ $details->Product_sales_quantity }}</td>
                    <td>{{ number_format($details->Product_price, 0, ',', '.') . ' ' . '₫'  }}</td> 
                   <td>{{  number_format($subtotal, 0, ',', '.') . ' ' . '₫' }} </td>   
                   

                </tr>
                @endforeach
                <tr>
                    <td>
                        Tổng thanh toán: {{ number_format($total, 0, ',', '.') . ' ' . '₫' }} 
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
