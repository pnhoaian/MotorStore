<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="An Hoài">
    <title>Home | Hoai An Motor</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
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
				<div class="row">
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
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
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
					<div class="col-sm-4">
                  
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-user"></i> Tài Khoản</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<li><a href="login.html"><i class="fa fa-lock"></i> Đăng nhập</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="logo pull-left">
							<a href="index.html"><img src="{{asset('public/frontend/images/logo-no-background.jpg')}}" alt="" 
							style="margin-top: -50px;
							margin-left: -150px;
							width: 275px;
							height: auto;"/></a>
						</div>
						<div class="mainmenu center">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('trang-chu')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Danh Mục<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Giỏ hàng</a></li> 
										<li><a href="login.html">Đăng nhập</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Hãng<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="#">Giới thiệu</a></li>
								<li><a href="contact-us.html">Liên Hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Tìm kiếm sản phẩm"/>
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
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>An Hoai</span> Motor</h1>
									<h2>Ride With Passion</h2>
									<p>Tự hào là nhà phân phối xe Mô-tô phân khối lớn, phụ tùng và dịch vụ bảo trì xe chất lượng cao hàng đầu tại TP.HCM.</p>
									<button type="button" class="btn btn-default get">Tham khảo ngay</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/frontend/images/girl1.jpg')}}" class="girl img-responsive" alt="" />
									{{-- <img src="{{asset('public/frontend/images/pricing.png')}}"  class="pricing" alt="" /> --}}
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>An Hoai</span> Motor</h1>
									<h2>Ride With Passion</h2>
									<p>Tự hào là nhà phân phối xe Mô-tô phân khối lớn, phụ tùng và dịch vụ bảo trì xe chất lượng cao hàng đầu tại TP.HCM.</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/frontend/images/girl3.jpg')}}" class="girl img-responsive" alt="" />
									<img src="{{asset('public/frontend/images/pricing.png')}}" class="pricing" alt="" />
								</div>
							</div>
							
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
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach ($category as $key =>$cate )
								
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham'.$cate->category_id)}}">{{ $cate->category_name }}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Hãng</h2>
							<div class="brands-name">
								@foreach ($brand as $key =>$brand )
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/thuong-hieu'.$brand->brand_id)}}"> <span class="pull-right">(50)</span>{{ $brand->brand_name }}</a></li>
								</ul>
								@endforeach
							</div>
						</div><!--/brands_products-->
						
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
						</div><!--/shipping--> --}}
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
                    @yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Hoài An</span> Motor</h2>
							<p>Tự hào là nhà phân phối xe Mô-tô phân khối lớn, phụ tùng và dịch vụ bảo trì xe chất lượng cao hàng đầu tại TP.HCM.</p>
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
								<p>Founder Of HAM</p>
								<h2>14 JULY 2023</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{asset('public/frontend/images/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
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
								<li><a href="#">Giới thiệu</a></li>
								<li><a href="#">Liên hệ</a></li>
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
</body>
</html>