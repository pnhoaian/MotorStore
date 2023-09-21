@extends('welcome')
@section('content')

<div class="features_items">
                        <!--       features_items            -->
                        @foreach ($brand_name as $key => $bra_name)
							<h2 class="title text-center">{{ $bra_name->brand_name }}</h2>
						@endforeach
						@foreach ($brand_by_id as $key => $product)	
							<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">			
								<div class="col-sm-4">
									<div class="productinfo text-center">
										<form>
											@csrf
											<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
											<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

											<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
											<img src="{{URL::to('/public/upload/product/'.$product->product_image)}}" alt="" />
											{{-- <h2>{{ number_format($product->product_price).' '.'VNĐ'}}</h2> --}}
											<h2>{{ $product->product_name }}</h2>
											<p>{{ number_format($product->product_price, 0, ',', '.') . ' ' . 'VNĐ' }}</p>
											
											</a>
											<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
												Thêm vào giỏ hàng</button>
										</form>
									</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-heart"></i>Danh sách yêu thích</a></li>
												<li><a href="#"><i class="fa fa-plus-square"></i>So Sánh Sản Phẩm</a></li>
											</ul>
										</div>
									</div>
								</div>
							</a>
						@endforeach
					</div><!--features_items-->
					


@endsection