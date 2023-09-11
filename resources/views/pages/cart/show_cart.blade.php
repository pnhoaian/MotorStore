@extends('welcome')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
        <div class="table-responsive cart_info">
            <form action="{{URL::to('/update-cart')}}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh sản phẩm</td>
                        <td class="description">Tên Sản phẩm</td>
                        <td class="price" style="width:200px">Giá tiền</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td>Tác vụ</td>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('cart'))
                    @php
                        $total = 0;
                    @endphp
                    @php
                        $i = 0;
                    @endphp

                    @foreach (Session::get('cart') as $key => $cart)
                        @php
 
                            $subtotal = $cart['product_price']*$cart['product_qty'];
                            $total += $subtotal;
                        @endphp

                        
                        <tr>
                            <td class="cart_product" style="width:250px;padding-left:15px">
                                <img src="{{asset('public/upload/product/'.$cart['product_image'])}}" width="150px" height="110px" alt="{{$cart['product_image']}}">

                            </td>
                            <td class="cart_description">
                                <h4 style="margin-bottom: 20px;"><a>{{ $cart['product_name']}}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($cart['product_price'],0,',','.' )}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    
                                        <input style="margin-bottom: 12px;width:100px" class="cart_quantity" type="number" name="cart_qty[{{ $cart['session_id'] }}]" min="1" value="{{ $cart['product_qty'] }}">
                                        
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ number_format($subtotal,0,',','.' )}} VNĐ</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('/del-product/'.$cart['session_id'])}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>        

                    @endforeach
                    <tr>

                        <td><input type="submit" value="Cập Nhật giỏ hàng" name="update-qty" class="check_out btn btn-default btn-sm"></td>
                        <td>
                            <a class="btn btn-default check_out" href="{{URL::to('/del-all-product')}}">Xóa tất cả</a>
                        </td>

                        <td>
                            @if (Session::get('coupon'))
                            <a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa mã Coupon</a>
                            @endif
                        </td>

                        <td class="bill" style="width:300px;padding-left:60px">
                            <li>Tổng thành tiền: <span>{{ number_format($total,0,',','.' )}} VNĐ</span></li>
                            {{-- <li>Thuế: <span></span></li> --}}
                            <li>Phí vận chuyển: <span>Free Ship</span></li>
                                @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key => $cou)
                                            @if ($cou['coupon_condition'] == 1)
                                            <li>Mã giảm giá : {{ $cou['coupon_number'] }} %
                                                @php
                                                    $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                    
                                                @endphp
                                            </li>
                                            <li>
                                                @php
                                                    $total_after_coupon = $total - $total_coupon;
                                                @endphp
                                                Tiết kiệm được:
                                                {{ number_format($total_coupon, 0, ',', '.') }} đ
                                            </li>
                                                
                                            
                                            @elseif($cou['coupon_condition'] == 2)
                                            <li>Mã giảm giá:
                                                {{ number_format($cou['coupon_number'], 0, ',', '.') }} đ
                                                @php
                                                    $total_coupon = $total - $cou['coupon_number'];
                                                    
                                                @endphp
                                            </li>
                                            <li>
                                                @php
                                                    $total_after_coupon = $total_coupon;
                                                @endphp
                                                Tiết kiệm được:
                                                {{ number_format($cou['coupon_number'], 0, ',', '.') }} đ
                                            </li>
                                        @endif
                                        @endforeach
                                
                            
                                </li>
                        
                        @endif
                        <li style="color: #D0021B;">Tổng thanh toán:
                            @php
                                if ( Session::get('coupon')) {
                                    $total_after = $total_after_coupon;
                                    $total_after = $total_after + Session::get('fee');
                                    echo number_format($total_after, 0, ',', '.') . ' đ';
                                } elseif ( !Session::get('coupon')) {
                                    $total_after = $total;
                                    echo number_format($total_after, 0, ',', '.') . ' đ';
                                }
                                
                            @endphp
                        </li>
                        </td>
                    </tr>
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center">
                                @php
                                    echo'Không có sản phẩm trong giỏ hàng';
                                @endphp
                            </td>
                        </tr>
                    @endif
                </tbody>
            </form>


                {{-- Kiểm tra tồn tại sản phẩm trong giỏ hàng mới xuất hiện khung giảm giá --}}
                @if (Session::get('cart') && Session::get('coupon'))
                @elseif(Session::get('cart'))
                <tr>
                    <td ></td>
                        <form method="POST" action="{{URL::to('/check-coupon')}}">
                            @csrf
                            <input type="text" class="form-control" name="coupon" placeholder="Mã giảm giá">
                            <br>
                            <input type="submit" class="btn btn-default check_coupon" value="Áp dụng mã giảm giá" name="check_coupon">
                        </form>
                    </td>

                    

                    <td>
                        <a class="btn btn-default check_out" href="">Thanh Toán</a>
                    </td>
                </tr>
            @endif
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection