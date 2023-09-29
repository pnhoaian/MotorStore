<!DOCTYPE HTML>
<html lang="en">
<head>
<title> Sign Up | Hoai An Motor </title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="{{asset('public/frontend/css/style.css')}}" rel='stylesheet' type='text/css' media="all" /><!-- Style-CSS --> 
<link href="{{asset('public/frontend/css/font-awesome1.css')}}" rel="stylesheet"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<link rel="shortcut icon" href="{{asset('public/frontend/images/favicon.png')}}">
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->
</head>
<body>
<!-- main -->
<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		{{-- <h1>Online Login Form</h1> --}}
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>Đăng ký tài khoản mới</h2>
			</div>
			<form action="{{URL::to('/admin-dashboard')}}" method="post">
				{{ csrf_field() }}
                <div class="pom-agile">
					<input  placeholder="Tên người dùng" name="customer_name" class="pass" type="text" required="">
				</div>
				<div class="pom-agile">
					<input placeholder="E-mail" name="customer_email" class="user" type="email" required="">
				</div>
                <div class="pom-agile">
					<input  placeholder="Nhập số điện thoại" name="customer_phone" class="pass" type="tel" required="">
				</div>
				<div class="pom-agile">
					<input  placeholder="Nhập Password" name="customer_email" class="pass" type="password" required="">
				</div>
                <div class="pom-agile">
					<input  placeholder="Nhập lại Password" name="customer_email" class="pass" type="password" required="">
				</div>
				<div class="sub-w3l">
					<h6><a href="{{URL::to('login')}}">Đã có tài khoản</a></h6>
					<div class="right-w3l">
						<input type="submit" value="Đăng ký">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--//main-->
	<!--footer-->
	<div class="footer">
		<p>&copy; 2023 All rights reserved | Design by <a href="#">Hoài An Motor</a></p>
	</div>
	<!--//footer-->
</div>
</body>
</html>