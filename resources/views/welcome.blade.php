
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="An Hoài">
    <title>Hoài An Store | Cáp, Sạc chính hãng</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/jquery-ui.min.css')}}" rel="stylesheet">


	<!--CSS Toast thông báo-->
	<link href="{{asset('public/frontend/css/toastr.min.css')}}" rel="stylesheet">
	<!--fontawesome bản mới-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/images/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

</head><!--/head-->

<body><!--header-->
	<header id="header">

		<!--header_top-->
		<div class="header_top">
			<div class="container">
				<div class="row" >
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> Hotline: +84 99 1919 191</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> hoaianstore.vn@gmail.com</a></li>
							</ul>
						</div>
					</div>




<?php 
									$customer_id = Session::get('customer_id');
									if($customer_id!=NULL){

								?>
                                <li class="dropdown"
                                    style="display: inline;
                                width: 132px;
								left: 465px;
								top: 7px"><i
                                        class="fas fa-user" style="font-weight: 600;font-size: 15px;color: #FFF;"></i>
                                    <a style="display: inline-flex;" data-toggle="dropdown" class="dropdown-toggle"
                                        href="#">
                                        <span class="username" style="font-weight: 600;font-size: 15px;color: #FFF;"> Xin chào, 
                                            {{ Session::get('customer_name') }}
                                        </span>
                                        <b style="margin-top: 9px;
                                        margin-left: 3px;"
                                            class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu extended logout"
                                        style="width: 165px;
                                    left: -10px;">
											<li><a href="{{ URL::to('/my-information') }}"></i>
												<i class="fa fa-cogs" aria-hidden="true" style="margin-right: 10px;margin-left: -10px">
												</i>Chỉnh sửa thông tin</a>
											</li>
											
											<li><a href="{{ URL::to('/history') }}"></i>
												<i class="fa fa-history" aria-hidden="true" style="margin-right: 10px;margin-left: -10px">
												</i>Lịch sử đơn hàng</a>
											</li>

											<li><a href="{{ URL::to('/logout-customer') }}">
											<i class="fa fa-outdent" aria-hidden="true" style="margin-right: 10px;margin-left: -10px">
											</i>Đăng xuất</a></li>
                                    </ul>
                                </li>
                                {{-- <li><a href="{{ URL::to('/logout-checkout') }}"><i class="fas fa-user"></i>Đăng
                                        xuất</a></li> --}}

                                <?php 

									} else{
								?>
                                <li style="display: inline-flex;width: 132px; margin-left: 450px; padding-top: 9px; font-weight: 600; font-size: 15px; color: #FFF;">
									<a href="{{ URL::to('/login') }}" style="font-weight: 600;font-size: 15px;color: #FFF;">
										<i class="fas fa-user" ></i>  Đăng nhập</a></li>
                                <?php
									}
								?>
				</ul>



				</div>
			</div>
		</div>
		<!--/end header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="logo pull-left">
							<a href="{{URL::to('trang-chu')}}"><img src="{{asset('public/frontend/images/logo-no-background.png')}}" alt="" 
							style="margin-top: 0px;
							margin-left: -60px;
							width: 70%;
							height: 85%;"/></a>
						</div>
					</div>
					<div class="mainmenu center col-sm-5" style="
					width: 58%;
					margin-left: -115px;
				">
						
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="{{URL::to('trang-chu')}}" class="active">Home</a></li>

							<li class="dropdown"><a href="#">Danh Mục<i class="fa fa-angle-down"></i></a>
								<h4 class="panel-title"></h4>
								<ul role="menu" class="sub-menu">
									@foreach ($category as $key =>$cate )
										<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{ $cate->category_name }}</a></li>
									@endforeach
								</ul>
							</li> 

							<li class="dropdown"><a href="#">Hãng<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									@foreach ($brand as $key =>$brand1 )
										<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand1->brand_id)}}">{{ $brand1->brand_name }}</a></li>
									@endforeach
								</ul>
							</li> 
							<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									@foreach ($category_post as $key =>$cate_post )
									<li><a
											href="{{ URL::to('/danh-muc-bai-viet/' . $cate_post->cate_post_id) }}">{{ $cate_post->cate_post_name }}</a>
									</li>
								@endforeach
								</ul>
							</li> 

							<li><a href="{{URL::to('gioi-thieu')}}">Giới thiệu</a></li>
							<li><a href="{{URL::to('lien-he')}}">Liên Hệ</a></li>
							<li class="test-s" style="
							margin-top: -6px;">
								<form action="{{URL::to('/tim-kiem')}}" method="POST">
									{{ csrf_field() }}
									<div class="search_box pull-right">
										<div style="display: flex">
											<input type="text" name="keywords_submit" id="keywords"
												placeholder="Tìm kiếm sản phẩm..." />
											<input type="submit"  value="Tìm" style="color: #FFF;    font-family: -apple-system, system-ui, BlinkMacSystemFont;    font-weight: 600;" class="button-timkiem" name="search_item"/>
		
										</div>
									</div>
								</form>
							</li>
						</ul>
						
					</div>




					<div class="col-sm-4" style="margin-right: 15px;margin-top: -6px;width: 22%;">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								{{-- <li><a href="#"><i class="fa fa-user"></i> Tài Khoản</a></li> --}}
								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="navbar-header">
							{{-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button> --}}
						</div>
						
					</div>
					
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

													<!--slider-->
		@yield('slider')

													{{-- <!--Lọc sản phẩm -->
		<div class="filter-sort__title" >Chọn theo danh mục</div>
		<div class="filter-wrapper" style="display:flex;">
			@foreach ($category as $key =>$cate )
			<button class="btn-filter button__filter-parent">
				{{ $cate->category_name }}
			@endforeach
			</button>
		</div> --}}
	
	<section >
		<div class="container"> 
			<div class="row">
				{{--  <div class="col-sm-3">
					 <div class="left-sidebar">
						<h2>Danh Mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach ($category as $key =>$cate )
								
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{ $cate->category_name }}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Hãng</h2>
							<div class="brands-name">
								@foreach ($brand as $key =>$brand )
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right">(50)</span>{{ $brand->brand_name }}</a></li>
								</ul>
								@endforeach
							</div>
						</div> --}}
						<!--/brands_products-->
						
						{{-- <div class="price-range"><!--price-range-->
							<h2>Giá Tiền</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="500000000" data-slider-step="5" data-slider-value="[0,500000000]" id="sl2" ><br />
								 <b class="pull-left">0 VNĐ</b> <b class="pull-right">500.000.000 VNĐ</b>
							</div>
						</div><!--/price-range--> --}}
						
						{{-- hình ship --}}
						{{-- <div class="shipping text-center"><!--shipping-->
							<img src="{{asset('public/frontend/images/shipping.jpg')}}" alt="" />
						</div><!--/shipping--> 
					
					</div> --}}
					<div class="col-sm-12 " style="padding-left:0; margin-bottom: 20px;">
						@yield('content')
					</div>


					@yield('footer')
				

				

					</div>
				</div>
			</div>
		</div>
	</section>

	
	<!--Footer-->
	<footer id="footer" style="margin-top: 20px">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Hoài An</span> Store</h2>
							<p>Tự hào là nhà phân phối phụ kiện pin, sạc chính hãng - chất lượng - an toàn - giá thành thành tốt nhất hàng đầu tại TP.HCM.</p>
						</div>
					</div>

					{{-- <div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/man-one.jpg')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Founder Of HAS</p>
								<h2>14 JULY 2023</h2>
							</div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="address">
							<img src="{{asset('public/frontend/images/map.png')}}" alt="" />
							<p style="text-align: center">180 Cao Lỗ, phường 4, Quận 8, Tp HCM</p>
						</div>
					</div> --}}

					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Thông tin</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="{{URL::to('gioi-thieu')}}">Giới thiệu</a></li>
								<li><a href="{{URL::to('lien-he')}}">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Sản Phẩm & Dịch Vụ</h2>
							<ul class="nav nav-pills nav-stacked"></ul>
								<li class="ftsanpham"><a href="#">Apple</a></li>
								<li class="ftsanpham"><a href="#">Samsung</a></li>
								<li class="ftsanpham"><a href="#">Baseus</a></li>

							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính Sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thanh toán</a></li>
								<li><a href="#">Bảo hành - Bảo trì</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Đăng ký nhận tin</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><p>Tư vấn về sản phẩm & dịch vụ</p></li>
									<li><p>Nhận thông tin khuyến mãi</p></li>
									<li><p>Góp ý - Khiếu nại về dịch vụ, sản phẩm</p></li>
								</ul>
								{{-- <form action="#" class="searchform">
									<input type="text" placeholder="Gmail" />
									<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
									
							</form> --}}
						</div>
					</div>

				</div>
			</div>
		</div>
		
		{{-- <div class="footer-widget">
			<div class="container">
				<div class="row">
					
					
				</div>
			</div>
		</div> --}}
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull"> Copyright © 2023 - Hoai An Store</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	<!-- Messenger Plugin chat Code -->
    

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0"
        nonce="ObII9EbG">
	</script>
	
	<script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v17.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

   {{-- Lọc giá --}}
   <script type="text/javascript">
	$(document).ready(function() {

		$("#slider-range").slider({
			orientation: "horizontal",
			range: true,
			min: {{ $min_price }},
			max: {{ $max_price }},
			step: 100000,
			values: [{{ $min_price }}, {{ $max_price }}],

			slide: function(event, ui) {
				$("#amount_start").val(ui.values[0]).simpleMoneyFormat();
				$("#amount_end").val(ui.values[1]).simpleMoneyFormat();

				$("#start_price").val(ui.values[0]);
				$("#end_price").val(ui.values[1]);

			}
		});
		$("#amount_start").val($("#slider-range").slider("values", 0)).simpleMoneyFormat();
		$("#amount_end").val($("#slider-range").slider("values", 1)).simpleMoneyFormat();

	});
</script>
	{{-- lọc Sp --}}
	<script type="text/javascript">
        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                // alert(url);
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>


	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script> --}}
	{{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
	<script src="{{asset('public/frontend/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>

	 <!--TV s/d Toast-->
	<script src="{{asset('public/frontend/js/toastr.min.js')}}"></script> 

    <!--Hiện thị thông báo-->
	{!! Toastr::message() !!}

    
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_price_sale = $('.cart_product_price_sale_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

			$.ajax({
                	url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
					data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_price_sale:cart_product_price_sale,cart_product_qty:cart_product_qty,_token:_token},
					success:function(data){
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể tiếp tục mua hàng hoặc tới giỏ hàng để tiến hành thanh toán",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false
						},
		function() {
			window.location.href = "{{url('/show-cart')}}"; });
		}

					});
		});
		});
	</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.send_order').click(function() {
			var shipping_email = $('.shipping_email').val();
			var shipping_name = $('.shipping_name').val();
			var shipping_address = $('.shipping_address').val();
			var shipping_phone = $('.shipping_phone').val();
			var shipping_note = $('.shipping_note').val();
			var shipping_method_pay = $('.shipping_method_pay').val();
			var shipping_method_receive = $('.shipping_method_receive').val();
			// var order_fee = $('.order_fee').val();
			var order_coupon = $('.order_coupon').val();
			var _token = $('input[name="_token"]').val();


			// if (shipping_name == '' || shipping_phone == '' || shipping_address == '') {
			//     alert('Chưa nhập thông tin yêu cầu');
			// }

			$.ajax({
				url: '{{ url('/confirm-order') }}',
				method: 'POST',
				data: {
					shipping_email: shipping_email,
					shipping_name: shipping_name,
					shipping_phone: shipping_phone,
					shipping_address: shipping_address,
					shipping_note: shipping_note,
					_token: _token,
					order_coupon: order_coupon,
					shipping_method_pay: shipping_method_pay,
					shipping_method_receive: shipping_method_receive
				},
				success: function() {
					if (shipping_method_pay == 0) {
						window.location.href =
							"{{ url('/checkout') }}";
					} else {
						window.location.href =
							"{{ url('/gioi-thieu') }}";
					}

				},
				error: function(error) {
					var formErr = error.responseJSON.errors;
					var str = ' <ul>';
					for (var err in formErr) {
						str += '<li> ' + formErr[err][0] +
							'</li>';
					}
					str += '</ul>';
					$('#form-errors').html(str);
				}
			});

		});


	});
</script>




</body>
</html>