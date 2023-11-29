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

Route::get('/login', [CustomerController::class, 'login']);
Route::get('/register', [CustomerController::class, 'register']);
Route::post('/dashboard', [CustomerController::class, 'show_dashboard']);
Route::get('/user-logout', [CustomerController::class, 'user_logout']);

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


//*********************************************************** Admin *************************************************************
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);


//************* Category Product *************
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);

Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

//- Update Category Product
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);
Route::get('/inactive-category-product/{category_product_id}', [CategoryProduct::class, 'inactive_category_product']);


//************* Brand Product *************
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);

Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);

//- Update Brand Product
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);
Route::get('/inactive-brand-product/{brand_product_id}', [BrandProduct::class, 'inactive_brand_product']);

//-------------------------  Category Post ------------------------- 
Route::get('/add-category-post', [CategoryPost::class, 'add_category_post']);
Route::get('/all-category-post', [CategoryPost::class, 'all_category_post']);
Route::post('/save-category-post', [CategoryPost::class, 'save_category_post']);
Route::get('/edit-category-post/{category_post_id}', [CategoryPost::class, 'edit_category_post']);

Route::post('/update-category-post/{cate_id }', [CategoryPost::class, 'update_category_post']);
Route::get('/delete-category-post/{cate_id}', [CategoryPost::class, 'delete_category_post']);
Route::get('/danh-muc-bai-viet/{cate_post_slug}', [CategoryPost::class, 'danh_muc_bai_viet']);


//---------------------------  Product --------------------------- 
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);

Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

//---------------------------  Cart --------------------------- 
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/add-cart', [CartController::class, 'add_cart']);

Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart', [CartController::class, 'delete_to_cart']);

Route::get('/del-product/{session_id}',[CartController::class, 'delete_product']);
Route::get('/del-all-product',[CartController::class, 'del_all_product']);

//---------------------------  Coupon --------------------------- 
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

