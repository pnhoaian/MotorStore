@extends('welcome')
@section('content')

<div class="features_items">
                        <!--       features_items            -->
						@foreach ($category_name as $key => $cate_name)
						<h2 class="title text-center">{{ $cate_name->category_name }} </h2>
						@endforeach

					<div class="row" style="margin-bottom: 10px">
						<div class="col-md-4">
							<label for="amout">Sắp xếp theo</label>
							<form>
								@csrf
								<select name="sort" id="sort" class="form-control">
									<option value="{{ Request::url() }}?sort_by=none">--------- Lọc sản phẩm ---------</option>
									<option value="{{ Request::url() }}?sort_by=tang_dan">------- Giá tăng dần -------</option>
									<option value="{{ Request::url() }}?sort_by= giam_dan">------- Giá giảm dần -------</option>
									<option value="{{ Request::url() }}?sort_by=kytu_az">------ Lọc theo tên sản phẩm A đến Z -----</option>
									<option value="{{ Request::url() }}?sort_by=kytu_za">------ Lọc theo tên sản phẩm Z đến A -----</option>	
								</select>
							</form>
						</div>

						<div class="col-md-4">
							<label for="amount">Phân khúc</label>
							<form>
								<div id="slider-range"></div>
								<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
								<input type="hidden" id="start_price" name="start_price">
								<input type="hidden" id="end_price" name="end_price">

								<br>
								<input type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-default"> 
							</form>
						</div>
					</div>

						@foreach ($category_by_id as $key => $product)		
							{{-- <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}"> --}}
								<a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">

									<div class="col-sm-2" style="width: 20%;padding-right: 0">
										<div class="product-image-wrapper">
											<div class="single-products">
													<div class="productinfo text-center">
														<form style="height: 370px;">
															@csrf
															<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
															<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
															<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
															<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
															<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
		
															<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
																@if ($product->product_price_sale != '0')
												<p class="giamgia" style="font-size: 15px">
													Giảm&nbsp;
													{{ number_format(100 - ($product->product_price_sale * 100) / $product->product_price, 0, ',', '.') . ' ' . '%' }}
		
												</p>
											@else
											<p class="khonggiamgia" ></p>
											@endif
															<img src="{{URL::to('/public/upload/product/'.$product->product_image)}}" alt="" />
															{{-- <h2>{{ number_format($product->product_price).' '.'VNĐ'}}</h2> --}}
															<h2>{{ $product->product_name }}</h2>
		
		
															<div class="price_sale" style="    align-items: flex-end;
															color: #444;
															font-family: sans-serif;
															font-weight: 700;
															line-height: 1.4;
															display: flex;">
		
																
															
																@if ($product->product_price_sale != 0)
																<p style="color: #d70018;
																display: inline-block;
																font-size: 18px;
																font-weight: 700;
																line-height: 1.1;" >{{ number_format($product->product_price_sale, 0, ',', '.') . ' ' . '₫' }}</p>
																<p style="color: #707070;
																display: inline-block;
																font-size: 14px;
																font-weight: 600;
																position: relative;
																-webkit-text-decoration: line-through;
																text-decoration: line-through;
																top: 2px;">{{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
													   
													</p>
													
												@else
												<p style="color: #d70018;
												display: inline-block;
												font-size: 18px;
												font-weight: 700;
												text-align: center;
												line-height: 1.1;" >{{ number_format($product->product_price, 0, ',', '.') . ' ' . '₫' }}</p>
												@endif</div>
															
															</a>
															
															<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart" >
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
					</div><!--features_items-->
					


@endsection