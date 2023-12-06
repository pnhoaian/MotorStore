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
        <div class="product-information"><!--/product-information-->
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

                        <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_{{ $value->product_id }}">

                <span>
                    <span class="col-sm-12">Giá Bán: {{number_format( $value->product_price, 0, ',', '.') . ' ' . 'đ̲' }}</span>
                </span>
                <span>
                    <label>Số Lượng:</label>
                    <input name="product_qty" type="number" min="1"
                                class="cart_product_qty_{{ $value->product_id }}" value="1" />
                    <input name="productid_hidden" type="hidden" value="{{ $value->product_id }}" />
                    {{-- <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart" name="add-to-cart"></i>
                        Thêm vào giỏ hàng
                    </button> --}}
                    <button type="button"
                            class="btn btn-fefault add-to-cart" data-id_product="{{ $value->product_id }}"
                            name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                    </button>
                </span>
            </form>

            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Thương Hiệu - Hãng:</b> {{ $value->brand_name }}</p>
            <p><b>Danh Mục:</b> {{ $value->category_name }}</p>
            {{-- <p><b>Đã bán:</b> {{ $value->category_name }}</p>
            <p><b>Tồn kho:</b> {{ $value->category_name }} sản phẩm</p> --}}
            {{-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> --}}
        </div><!--/product-information-->
    </div>

    <div class="col-sm-3">
        <div class="block" style="margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 6px;
        clear: both;">
            <div class="phone" style="margin-bottom: 15px;">
                <strong>
                    <span data-redactor-tag="span" style="color: rgb(0, 0, 0); margin-left:50px; ">Hồ Chí Minh</span> : 0912 456 789</strong><br>
            </div>

            <div class="GiaoHang">
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Thanh toán thẻ ATM miễn phí tại cửa hàng<span style="color: rgb(238, 236, 225);"></span></i>
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Trả Góp: Trả trước 30% + CMND + Hộ khẩu / Bằng lái</span></i> 
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Trả Góp: Dùng thẻ tín dụng lãi suất 0%</span></i> 
                <i class="fa fa-check" aria-hidden="true" style="margin-bottom: 10px; font-size: 15px;"> Thanh toán thẻ MASTER, VISA +<strong>1.5%</strong></span></i> 
            </div>
        </div>

        <div class="block" style="margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 6px;
        clear: both;">
            <div class="pr-top" style="    border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #f6f6f6;">
                <h4 class="pr-txtb" style="margin-left: 5px; text-align: center"> Khuyến Mãi</h4>
                <i class="pr-txt" style="margin-left: 5px;"> Đặt ngay và áp dụng khuyến mãi để được hưởng nhiều ưu đãi hấp dẫn từ Hoài An Store </i>
            </div>
            <div class="pr-content">
                <div class="pr-item">
            <div>
                <ul>
                    <li></li>
                        
                    </li>
                </ul>
                <p>Nhập mã UUDAI50k giảm ngay 50K cho đơn hàng khi mua sắm online</a></p>
                            
                
            </div>
            <div class="divb t5" data-promotion="2039089" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="20">
                <span class="nb">2</span>
                <div class="divb-right">
                            <p>Hoàn 200,000đ cho chủ thẻ tín dụng HOME CREDIT khi thanh toán đơn hàng từ 5,000,000đ <a href="https://www.thegioididong.com/tin-tuc/hoan-tien-den-200K-khi-thanh-toan-qua-homecredit-1553498" target="_blank">(Xem chi tiết tại đây)</a></p>
                </div>
            </div>
                </div>

                


                
            <div class="pr-item text">
                <p><span class="note">(*)</span> Giá hoặc khuyến mãi không áp dụng trả góp lãi suất đặc biệt (0%, 0.5%, 1%, 1.5%, 2%)</p>
            </div>
 
            </div>
        </div>
    </div>

</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Sản phẩm liên quan</a></li>
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
                            <h2>{{number_format( $value->product_price, 0, ',', '.') . ' ' . 'đ̲' }}</h2>
                            <p>{{ $value->product_name }}</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Đánh giá sản phẩm</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ( $related_pro as $key => $SPLQ)
                    
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('/public/upload/product/'.$SPLQ->product_image)}}" alt="" />
                                <h2>{{number_format( $SPLQ->product_price, 0, ',', '.') . ' ' . 'đ̲' }}</h2>
                                <p>{{ $SPLQ->product_name }}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart" name="add-to-cart"></i>Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                @endforeach	
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->

@endsection