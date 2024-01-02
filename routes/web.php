<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\CategoryProduct; 
use App\Http\Controllers\BrandProduct; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\CartController; 
use App\Http\Controllers\CouponController; 
use App\Http\Controllers\SliderController; 
use App\Http\Controllers\ContactController; 
use App\Http\Controllers\IntroController; 
use App\Http\Controllers\CustomerController; 
use App\Http\Controllers\CategoryPost;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

*/

//  --------------------------------- User----------------------------------- 
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');

//--------------------------------------------------- Mail -----------------------------------------------------
//Send Mail
Route::get('/send-mail', [MailController::class, 'send_mail']);
//send Coupon
Route::get('/send-coupon', [MailController::class, 'send_coupon']);
// Xem demo send Coupon
Route::get('/demo-sendcoupon', [MailController::class, 'demo_sendcoupon']);

// **************************************************** Login + Cart Checkout  ******************-----**********************
Route::get('/login',[CheckoutController::class, 'login']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/register', [CheckoutController::class, 'register']);
Route::post('/register-customer', [CheckoutController::class, 'register_customer']);
//Route::post('/dashboard', [CustomerController::class, 'show_dashboard']);

Route::get('/my-information', [CheckoutController::class, 'my_information']);
Route::post('/update-information/{customers_id}', [CheckoutController::class, 'update_information']);

Route::get('/logout-customer', [CheckoutController::class, 'logout_customer']);

// Gửi thông tin đặt hàng -> DB
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);

//Btn xác nhận thanh toán cart FE
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);
//Kiem tra thong tin giao hang
Route::get('/payment', [CheckoutController::class, 'payment']);

//Kiem tra thong tin giao hang
Route::get('/checkout', [CheckoutController::class, 'checkout']);


//--**************************************************************  Order ****************************************************
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);
Route::get('/manage-order', [OrderController::class, 'manage_order']);

//in đơn hàng
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);
// Lịch sử đơn hàng
Route::get('/history', [OrderController::class, 'history']);

Route::get('/view-history-order/{order_code}', [OrderController::class, 'view_history_order']);
//update tình trạng đơn hàng
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
//xóa đơn
Route::get('/delete-order/{order_code}', [OrderController::class, 'delete_order']);
//cập nhật số lượng sản phẩm view đơn hàng
Route::post('/update-qty', [OrderController::class, 'update_qty']);

//--**************************************************************  Intro **********************************************************
//// ***FE: Page Liên hệ
Route::get('/lien-he',[ContactController::class, 'lien_he']);
//// BE: Page Liên hệ
Route::get('/information',[ContactController::class, 'information']);
Route::post('/save-information',[ContactController::class, 'save_information']);
Route::post('/update-info/{info_id}',[ContactController::class, 'update_info']);

//// ***FE: Page Gioi thieu
Route::get('/gioi-thieu',[IntroController::class, 'gioi_thieu']);
//// BE: Page Liên hệ
Route::get('/introduce',[IntroController::class, 'introduce']);
Route::post('/save-intro',[IntroController::class, 'save_intro']);
Route::post('/update-intro/{intro_id}',[IntroController::class, 'update_intro']);

// Route::post('/update-intro/{intro_id}',[IntroController::class, 'update_intro']);


//Show Items Danh Mục Sản Phẩm 
Route::get('/danh-muc-san-pham/{category_id}',[CategoryProduct::class, 'show_category_home']);
//Show Item Thương hiệu Sản Phẩm 
Route::get('/thuong-hieu-san-pham/{brand_id}',[BrandProduct::class,'show_brand_home']);
//Show chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}',[ProductController::class,'detail_product']);


//***************************************************************** Admin ***************************************************************
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//Thống kê
Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);

 
//// ************************************************** Bài viết  *******************************************************
Route::get('/danh-muc-bai-viet/{post_slug}', [PostController::class, 'danh_muc_bai_viet']);
Route::get('/bai-viet/{post_slug}', [PostController::class, 'bai_viet']);


//****************************************************** Category Product **********************************************
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);

Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::post('/update-category-product/{category_id}', [CategoryProduct::class, 'update_category_product']);

//- Update Category Product
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);
Route::get('/inactive-category-product/{category_product_id}', [CategoryProduct::class, 'inactive_category_product']);


//******************************************************** Brand Product *************************************************************
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);

Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::post('/update-brand-product/{brand_id}', [BrandProduct::class, 'update_brand_product']);

//- Update Brand Product Status
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);
Route::get('/inactive-brand-product/{brand_product_id}', [BrandProduct::class, 'inactive_brand_product']);


//-----------------------------------------------------  Category Post ---------------------------------------- 
Route::get('/add-category-post', [CategoryPost::class, 'add_category_post']);
Route::get('/all-category-post', [CategoryPost::class, 'all_category_post']);
Route::post('/save-category-post', [CategoryPost::class, 'save_category_post']);
Route::get('/edit-category-post/{category_post_id}', [CategoryPost::class, 'edit_category_post']);

Route::post('/update-category-post/{cate_id}', [CategoryPost::class, 'update_category_post']);
Route::get('/delete-category-post/{cate_id}', [CategoryPost::class, 'delete_category_post']);
Route::get('/danh-muc-bai-viet/{cate_post_slug}', [CategoryPost::class, 'danh_muc_bai_viet']);

Route::get('/active-category-post/{cate_post_id}', [CategoryPost::class, 'active_cate_post']);
Route::get('/inactive-category-post/{cate_post_id}', [CategoryPost::class, 'inactive_cate_post']);

//----------------------------------------------------  Post ---------------------------------------------------------- 
Route::get('/add-post', [PostController::class, 'add_post']);
Route::get('/all-post', [PostController::class, 'all_post']);
Route::post('/save-post', [PostController::class, 'save_post']);
Route::get('/edit-post/{post_id}', [PostController::class, 'edit_post']);

Route::post('/update-post/{post_id}', [PostController::class, 'update_post']);
Route::get('/delete-post/{post_id}', [PostController::class, 'delete_post']);

Route::get('/active-post/{post_id}', [PostController::class, 'active_post']);
Route::get('/inactive-post/{post_id}', [PostController::class, 'inactive_post']);

//----------------------------------------------------  Product -------------------------------------------------------- 
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);

Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

//Rating
Route::post('/insert-rating', [ProductController::class, 'insert_rating']);

//------------------------------------------------------  Cart ---------------------------------------------------------- 
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/add-cart', [CartController::class, 'add_cart']);

Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart', [CartController::class, 'delete_to_cart']);

Route::get('/del-product/{session_id}',[CartController::class, 'delete_product']);
Route::get('/del-all-product',[CartController::class, 'del_all_product']);


//-----------------------------------------------------  Coupon -------------------------------------------------------- 
//User
Route::post('/check-coupon', [CartController::class, 'check_coupon']);
Route::get('/unset-coupon', [CouponController::class, 'unset_coupon']);

//Admin
Route::get('/insert-coupon', [CouponController::class, 'insert_coupon']);
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);

Route::post('/insert-coupon-code', [CouponController::class, 'insert_coupon_code']);

//- Update Brand Product
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::get('/inactive-product/{product_id}', [ProductController::class, 'inactive_product']);

//-------------------------  Cart ------------------------- 
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);

//-------------------------  Banner ------------------------- 
Route::get('/manage-banner', [SliderController::class, 'manage_banner']);
Route::get('/add-slider', [SliderController::class, 'add_slider']);
Route::post('/insert-slider', [SliderController::class, 'insert_slider']);

Route::get('/edit-slider/{slider_id}', [SliderController::class, 'edit_slider']);
Route::get('/delete-slider/{slider_id}', [SliderController::class, 'delete_slider']);
Route::get('/active-slider/{slider_id}', [SliderController::class, 'active_slider']);
Route::get('/inactive-slider/{slider_id}', [SliderController::class, 'inactive_slider']);


