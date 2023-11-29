<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="An Hoài">
    <title>Hoài An Store | Pin, Sạc chính hãng</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
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
								<li><a href="#"><i class="fa fa-phone"></i> +84 99 1919 191</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> anhoaimotor@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>

							</ul>
						</div>
					</div>
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
							margin-left: -110px;
							width: 60%;
							height: 80%;"/></a>
						</div>
					</div>
					<div class="mainmenu center col-sm-5" style="
					width: 58%;
					margin-left: -210px;
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
										<li><a href="{{URL::to('/tin-tuc/'.$cate_post->cate_post_slug)}}">{{ $cate_post->cate_post_name }}</a></li>
									@endforeach
								</ul>
							</li> 

							<li><a href="{{URL::to('gioi-thieu')}}">Giới thiệu</a></li>
							<li><a href="{{URL::to('lien-he')}}">Liên Hệ</a></li>
							<li class="test-s" style="
							margin-top: -6px;>
								<form action="{{URL::to('/tim-kiem')}}" method="POST">
									{{ csrf_field() }}
									<div class="search_box pull-right">
										<div style="display: flex">
											<input type="text" name="keywords_submit" id="keywords"
												placeholder="Tìm kiếm sản phẩm..." />
											<button class="button-timkiem" name="search_item"><i class="fa fa-search"
													style="color: #fff"></i></button>
		
										</div>
									</div>
								</form>
							</li>
						</ul>
						
					</div>




					<div class="col-sm-4" style="
					margin-top: -6px;
				">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								{{-- <li><a href="#"><i class="fa fa-user"></i> Tài Khoản</a></li> --}}
								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<li><a href="{{URL::to('/login')}}"><i class="fa fa-user"></i> Đăng nhập</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
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
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
						</ol>
						
						<div class="carousel-inner">
							@php
								$i=0;
							@endphp
							@foreach ($slider as $key => $slide)
								@php
									$i++;
								@endphp
							<div class="item {{ $i==1 ? 'active' : '' }}">
								<div class="col-sm-12">
									<img alt="{{ $slide->slider_desc }}" src="{{ asset('public/upload/slider/' . $slide->slider_image) }}" class="img img-responsive">
									{{-- <img src="{{asset('public/frontend/images/pricing.png')}}"  class="pricing" alt="" /> --}}
								</div>
							</div>

							@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="brands__content">
			<div class="container">
				<div class="row">
					<div class="brands__content">
						<div class="list-brand">
	
							@foreach ($brand as $key => $brand1)
								@if ($brand1->brand_image != '')
									<a class="list-brand__item"
										href="{{ URL::to('/thuong-hieu-san-pham/' . $brand1->brand_id) }}"><img
											class="filter-brand__img"
											src="{{ asset('public/upload/brand/' . $brand1->brand_image) }}"></a>
								@else
								@endif
							@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>



	
	<section>
		<div class="container"></div>
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
				</div>
				
				<div class="col-sm-12 padding-right" style="margin-bottom: 60px">
                    @yield('content')
				</div>

				<div class="section-content relative">
					<div class="row row-large" id="row-1482279903">
						<div id="col-319689862" class="col-md-4">
							<div class="col-inner">
								<div class="icon-box featured-box icon-box-center text-center">
									<div class="icon-box-img" style="width: 50px">
										<div class="icon">
											<div class="icon-inner">
												<img style="width: 50px;
												height: 53px;
												margin-left: 155px;"
													src="https://quangphuong.vn/wp-content/uploads/2023/03/customer-service-5.png"
													class="attachment-medium size-medium" alt="" decoding="async"
													loading="lazy"
													srcset="https://quangphuong.vn/wp-content/uploads/2023/03/customer-service-5.png 120w, https://julyscent.com/wp-content/uploads/2023/07/customer-service-line-100x100.png 100w"
													sizes="(max-width: 120px) 100vw, 120px">
											</div>
										</div>
									</div>
									<div class="icon-box-text last-reset">
		
										<div id="text-2452321903" class="text">
		
											<h2 style="margin-top: 0;"><span
													style="color: #000000;font-family: -apple-system, system-ui, BlinkMacSystemFont;
												font-size: 20px;
												font-weight: 700;
												color: #000000;">Hỗ
													trợ 24/7</span></h2>
											<p><span style="color: #000000;">Tư vấn và hỗ trợ giải đáp nhanh chóng, chính xác với đầy đủ các dòng xe hiện đại.</span></p>
		
											<style>
												#text-2452321903 {
													color: rgb(0, 0, 0);
												}
		
												#text-2452321903>* {
													color: rgb(0, 0, 0);
												}
											</style>
										</div>
		
									</div>
								</div>
		
		
							</div>
						</div>
		
		
		
						<div id="col-125498996" class="col-md-4">
							<div class="col-inner">
								<div class="icon-box featured-box icon-box-center text-center">
									<div class="icon-box-img" style="width: 50px">
										<div class="icon">
											<div class="icon-inner">
												<img style="width: 50px;
												height: 53px;
												margin-left: 155px;"
													src="{{asset('public/frontend/images/shipping2.png')}}"
													class="attachment-medium size-medium" alt="" decoding="async"
													loading="lazy"
													srcset="{{asset('public/frontend/images/shipping2.png')}} 120w, https://julyscent.com/wp-content/uploads/2023/07/archive-line-2-100x100.png 100w"
													sizes="(max-width: 120px) 100vw, 120px">
											</div>
										</div>
									</div>
									<div class="icon-box-text last-reset">
										<div id="text-2973815044" class="text">
											<h2 style="margin-top: 0;"><span
													style="color: #000000;font-family: -apple-system, system-ui, BlinkMacSystemFont;
											font-size: 20px;
											font-weight: 700;
											color: #000000;">Vận
													Chuyển</span></h2>
											<p>Miễn phí giao hàng tận nơi hoặc nhận trực tiếp cửa hàng</p>
		
											<style>
												#text-2973815044 {
													color: rgb(0, 0, 0);
												}
		
												#text-2973815044>* {
													color: rgb(0, 0, 0);
												}
											</style>
										</div>
									</div>
								</div>
							</div>
						</div>
		
		
						<div id="col-1248956169" class="col-md-4">
							<div class="col-inner">
								<div class="icon-box featured-box icon-box-center text-center">
									<div class="icon-box-img" style="width: 50px">
										<div class="icon">
											<div class="icon-inner">
												<img style="width: 50px;
												height: 53px;
												margin-left: 155px;"
													src="//theme.hstatic.net/200000281285/1000677821/14/policy_icon2.png?v=798"
													class="attachment-medium size-medium" alt="" decoding="async"
													loading="lazy"
													srcset="//theme.hstatic.net/200000281285/1000677821/14/policy_icon2.png?v=798 120w, https://julyscent.com/wp-content/uploads/2023/07/arrow-go-back-line-100x100.png 100w"
													sizes="(max-width: 120px) 100vw, 120px">
											</div>
										</div>
									</div>
									<div class="icon-box-text last-reset">
		
										<div id="text-3652484110" class="text">
		
											<h2 style="margin-top: 0;"><span
													style="color: #000000;font-family: -apple-system, system-ui, BlinkMacSystemFont;
											font-size: 20px;
											font-weight: 700;
											color: #000000;">Thanh Toán</span></h2>
											<p>Chấp nhận thanh toán bằng thẻ, tiền mặt hoặc hỗ trợ trả góp các hình thức khác</p>
		
											<style>
												#text-3652484110 {
													color: rgb(0, 0, 0);
												}
		
												#text-3652484110>* {
													color: rgb(0, 0, 0);
												}
											</style>
										</div>
		
									</div>
								</div>
							</div>
						</div>

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
					<div class="col-sm-7">
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
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
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
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Honda</a></li>
								<li><a href="#">Kawasaki</a></li>
								<li><a href="#">BMW</a></li>
								<li><a href="#">Phụ Tùng & Đồ chơi xe chính hãng</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính Sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thanh toán</a></li>
								<li><a href="#">Bảo hành - Bảo trì</a></li>
								<li><a href="#">Mua xe trả góp</a></li>
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
								<form action="#" class="searchform">
									<input type="text" placeholder="Gmail" />
									<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
									
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull">Copyright © 2023 Hoai An Motor. All rights reserved.</p>
					<p class="pull">Designed by <span><a target="_blank" href="#">An Hoài</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>

	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

			$.ajax({
                	url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
					data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
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

</body>
</html>