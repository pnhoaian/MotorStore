@extends('welcome')
@section('content')
@foreach ($product_detail as $key =>$value)
    
<div class="product-details"><!--product-details-->
    <div class="col-sm-4">
        <div class="view-product">

            <img src="{{URL::to('/public/upload/product/'.$value->product_image)}}" alt="" />
        </div>
        {{-- <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner1">
                    <div class="item active">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    
                </div>

              <!-- Hình ảnh chi tiết -->

              {{-- <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a> --}}
        {{-- </div> --}} 

    </div>

    <div class="col-sm-5">
        <div class="product-information" style="
        border: 1px solid #ccc;"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{ $value->product_name }}</h2>
            {{-- <p>ID Sản Phẩm: {{ $value->product_id }}</p> --}}
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="POST">
                {{ csrf_field()}}
                <input type="hidden" value="{{ $value->product_id }}"
                            class="cart_product_id_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_name }}"
                            class="cart_product_name_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_image }}"
                            class="cart_product_image_{{ $value->product_id }}">

                        {{-- <input type="hidden" value="{{ $value->product_qty }}"
                            class="cart_product_qty_{{ $value->product_id }}"> --}}

                        {{-- <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_{{ $value->product_id }}"> --}}

                         <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_sale_{{ $value->product_id }}">




            </form>
            <p><b>Mã sản phẩm:</b> {{ $value->product_id }}</p>
            <p><b>Thương Hiệu - Hãng:</b> {{ $value->brand_name }}</p>
            <p><b>Danh Mục:</b> {{ $value->category_name }}</p>
            <p><b>Số lượng tồn kho: </b> {{ $value->product_quantity }} </p>
            {{-- <p><b>Tình trạng:</b> 
                @if ($value->product_quantity >= 1)
                    Còn hàng
                    
                @else
                    Tạm hết hàng
                @endif
            </p> --}}
            <p><b>Đánh giá:</b>
                <ul class="list-inline rating" title="Average Rating">
                    @for ($count = 1; $count <= 5; $count++)
                        @php
                            if ($count <= $rating) {
                                $color = 'color:#ffcc00;';
                            } else {
                                $color = 'color:#ccc;';
                            }
                        @endphp
                        <li title="star_rating" style="cursor: default; {{ $color }} font-size:22px;">
                            &#9733;
                        </li>
                    @endfor </p></ul>


            <div>
                <p style="margin-top: -20px;"><b>Giá bán:</b><span style="    font-family: Tahoma, Geneva, sans-serif;
                font-size: 20px;
                font-weight: bold;
                font-style: normal;
                text-decoration: none;
                color: #f00;" class="cart_product_price_sale_">
                {{number_format( $value->product_price_sale, 0, ',', '.') . ' ' . 'đ̲' }}</span>
                

            <!--price_update_43154--></p>

            </div>

            <span style="margin-top: -10px;">
                {{-- <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart" name="add-to-cart"></i>
                    Thêm vào giỏ hàng
                </button> --}}
                @if ($value->product_quantity >= 1)
                    <label>Số Lượng:</label>
                    <input name="product_qty" type="number" min="1"
                                class="cart_product_qty_{{ $value->product_id }}" value="1" />
                    <input name="productid_hidden" type="hidden" value="{{ $value->product_id }}" />

                    <button type="button" class="btn btn-fefault add-to-cart" data-id_product="{{ $value->product_id }}" name="add-to-cart" 
                        style="margin-bottom: 8px;margin-left: 10px;"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                    </button>
                @else
                    <span>TẠM HẾT HÀNG</span>
                @endif

            </span>
            <p><b>Tags sản phẩm: </b> </p>
            {{-- <p><b>Đã bán:</b> {{ $value->category_name }}</p>
            <p><b>Tồn kho:</b> {{ $value->category_name }} sản phẩm</p> --}}
            {{-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> --}}
        </div><!--/product-information-->
    </div>

    <div class="col-sm-3">
        <div class="block" style="margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        clear: both;">
            <div class="phone" style="margin-bottom: 15px;">
                <strong>
                    <span data-redactor-tag="span" style="color: rgb(0, 0, 0); margin-left:350px; ">Hồ Chí Minh</span> : 0912 456 789</strong><br>
            </div>

            <div class="GiaoHang">
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Thanh toán thẻ ATM miễn phí tại cửa hàng<span style="color: rgb(238, 236, 225);"></span></i>
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Giao hàng nhanh chóng tiện lợi</span></i> 
            </div>
        </div>

        <div class="block" style="margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        clear: both;">
            <div class="pr-top" style="    border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #f6f6f6;">
                <h4 class="pr-txtb" style="margin-left: 5px; text-align: center"> Khuyến Mãi</h4>
                <i class="pr-txt" style="margin-left: 5px;font-style: normal;"> Đặt ngay và áp dụng khuyến mãi để được hưởng nhiều ưu đãi hấp dẫn.</i>
            </div>
            <div class="pr-content">
                <div class="pr-item">
            <div>
                <p>Nhập mã UUDAI50k giảm ngay 50K cho đơn hàng khi mua sắm online </a></p>
                <div class="pr-item text">
                    <p><span class="note">(*)</span> Khuyến mãi áp dụng cho đơn hàng giá trị trên 500,000đ</p>
                </div>     
                
            </div>
            <div class="divb t5" data-promotion="2039089" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="20">
                {{-- <span class="nb">2</span> --}}
                <div class="divb-right">
                            <p>Nhập mã UUDAI100k giảm ngay 100K cho đơn hàng khi mua sắm online <a href="#" target="_blank">(Xem chi tiết tại đây)</a></p>
                </div>
            </div>
                </div>
                
            <div class="pr-item text">
                <p><span class="note">(*)</span> Khi mua hàng với đơn hàng giá trị trên 1,500,000đ</p>
            </div>
 
            </div>
        </div>
    </div>

</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>

            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p>{!!$value->product_desc!!}</p>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>{{number_format( $value->product_price_sale, 0, ',', '.') . ' ' . 'đ̲' }}</h2>
                            <p>{{ $value->product_name }}</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id"
                        value="{{ $value->product_id }}">
                    <div id="comment_show">
                    </div>
                </form>

                    <?php 
                        $customer_id = Session::get('customer_id');
                        if($customer_id!=NULL){
                    ?>
                <p style="margin-top: 20px;margin-left:24px"><b>Viết đánh giá:</b></p>
                <ul style="margin-left:24px" class="list-inline rating" title="Average Rating">
                    @for ($count = 1; $count <= 5; $count++)
                        @php
                            if ($count <= $rating) {
                                $color = 'color:#ffcc00;';
                            } else {
                                $color = 'color:#ccc;';
                            }
                        @endphp

                        <li title="star_rating" id="{{ $value->product_id }}-{{ $count }}"
                            data-index="{{ $count }}" data-product_id="{{ $value->product_id }}"
                            data-rating="{{ $rating }}" class="rating"
                            style="cursor: pointer; {{ $color }} font-size:30px;">&#9733;
                        </li>
                    @endfor
                </ul>
                <form action="#">
                    <span>
                        <input
                            style="background: #f0f0f5;width: 60%;margin-left: 24px;color: #000;"
                            type="text" class="comment_name" placeholder="Tên hiển thị"/>
                    </span>
                    <textarea name="comment" style="    width: 93%;background: #f0f0f5;margin-left: 24px;color: #000;"
                        class="comment_content" placeholder="Nội dung"></textarea>
                    <div id="notify_comment"></div>

                    <button type="button" class="button-them pull-right send-comment">
                        Gửi
                    </button>

                </form>
                <?php 
                            } else{
                        ?>
                        <p>Vui lòng đăng nhập để đánh giá sản phẩm</p>
                <a class="btn btn-primary check_out"style="color: #fff;margin-left: 26px;height: 34px;}"
                    href="{{ URL::to('/login') }}">Đăng nhập ngay</a>
                <?php
                            }
                ?>

            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ( $related_pro as $key => $SPLQ)
                    
                <div class="col-sm-2" style="width: 20%;padding-right: 0">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <form style="height: 370px;">
                                        @csrf
                                        <input type="hidden" value="{{$SPLQ->product_id}}" class="cart_product_id_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_name}}" class="cart_product_name_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_image}}" class="cart_product_image_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_price}}" class="cart_product_price_{{$SPLQ->product_id}}">
                                        <input type="hidden" value="{{$SPLQ->product_price_sale }}"class="cart_product_price_sale_{{$SPLQ->product_id }}">
                                        <input type="hidden" value="1" class="cart_product_qty_{{$SPLQ->product_id}}">

                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$SPLQ->product_id)}}">
                                            @if ($SPLQ->product_price_sale != '0')
                            <p class="giamgia" style="font-size: 15px">
                                Giảm&nbsp;
                                {{ number_format(100 - ($SPLQ->product_price_sale * 100) / $SPLQ->product_price, 0, ',', '.') . ' ' . '%' }}

                            </p>
                        @else
                        <p class="khonggiamgia" ></p>
                        @endif
                                        <img src="{{URL::to('/public/upload/product/'.$SPLQ->product_image)}}" alt="" />
                                        {{-- <h2>{{ number_format($product->product_price).' '.'VNĐ'}}</h2> --}}
                                        <h2>{{ $SPLQ->product_name }}</h2>


                                        <div class="price_sale" style="    align-items: flex-end;
                                        color: #444;
                                        font-family: sans-serif;
                                        font-weight: 700;
                                        line-height: 1.4;
                                        display: flex;">

                                            
                                        
                                            @if ($SPLQ->product_price_sale != 0)
                                            <p style="color: #d70018;
                                            display: inline-block;
                                            font-size: 18px;
                                            font-weight: 700;
                                            line-height: 1.1;" >{{ number_format($SPLQ->product_price_sale, 0, ',', '.') . ' ' . '₫' }}</p>
                                            <p style="color: #707070;
                                            display: inline-block;
                                            font-size: 14px;
                                            font-weight: 600;
                                            position: relative;
                                            -webkit-text-decoration: line-through;
                                            text-decoration: line-through;
                                            top: 2px;">{{ number_format($SPLQ->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
                                   
                                </p>
                                
                            @else
                            <p style="color: #d70018;
                            display: inline-block;
                            font-size: 18px;
                            font-weight: 700;
                            text-align: center;
                            line-height: 1.1;" >{{ number_format($SPLQ->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
                            @endif</div>
                                        
                                        </a>
                                        
                                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$SPLQ->product_id}}" name="add-to-cart" >
                                            Thêm vào giỏ hàng</button>
                                    </form>
                                </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-heart"></i>Yêu thích</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                @endforeach	
            </div>
        </div>
         {{-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			 --}}
    </div>
</div><!--/recommended_items-->

@endsection