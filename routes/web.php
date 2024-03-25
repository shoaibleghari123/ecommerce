<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeBannerController;

use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/emailtest', [FrontController::class, 'send_mail']);


Route::get('/', [FrontController::class, 'index']);
Route::get('category/{slug}', [FrontController::class, 'category']);
Route::get('product/{slug}', [FrontController::class, 'product']);
Route::post('add_to_cart', [FrontController::class, 'add_to_cart']);
Route::post('add_qty_to_cart', [FrontController::class, 'add_qty_to_cart']);
Route::get('cart', [FrontController::class, 'cart']);
Route::get('search/{str}', [FrontController::class, 'search']);

Route::get('registration', [FrontController::class, 'registration']);
Route::post('register', [FrontController::class, 'register']);
Route::post('/login_process', [FrontController::class, 'login_process'])->name('login.login_process');
Route::post('/forgot_process', [FrontController::class, 'forgot_process']);
Route::get('/forgot_password_change/{id}', [FrontController::class, 'forgot_password_change']);
Route::get('/forgot_password_change_process/{id}', [FrontController::class, 'forgot_password_change_process']);

Route::post('/apply_coupon_code', [FrontController::class, 'apply_coupon_code']);
Route::post('/remove_coupon_code', [FrontController::class, 'remove_coupon_code']);

Route::post('/place_order', [FrontController::class, 'place_order']);
Route::get('/order_placed', [FrontController::class, 'order_placed']);

Route::get('/logout',[FrontController::class, 'logout'])->name('logout');
Route::get('/verification/{id}', [FrontController::class, 'email_verification']);

Route::get('/checkout', [FrontController::class, 'checkout']);



Route::get('test', [AdminController::class, 'test']);
Route::get('admin', [AdminController::class, 'index']);
//LoginRequest
Route::group(['middleware'=>'web'], function(){

    Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

});


Route::middleware(['admin_auth'])->group(function () {

Route::get('admin/dashboard', [AdminController::class, 'dashboard']);

// CATEGORY ROUTE
Route::get('admin/category', [CategoryController::class, 'index']);
Route::get('admin/category/manage_category',[CategoryController::class, 'manage_category']);
Route::get('admin/category/manage_category/{id}',[CategoryController::class, 'manage_category']);
Route::post('admin/category/manage_category_process',[CategoryController::class, 'manage_category_process'])->name('category.manage_category_process');
Route::get('admin/category/status/{status}/{id}', [CategoryController::class, 'status']);
Route::get('admin/category/delete/{id}',[CategoryController::class, 'delete']);
Route::get('admin/category/delete/{id}',[CategoryController::class, 'delete']);


    // COUPONS ROUTE

    Route::get('admin/coupon', [CouponController::class, 'index']);
    Route::get('admin/coupon/manage_coupon',[CouponController::class, 'manage_coupon']);
    Route::get('admin/coupon/manage_coupon/{id}',[CouponController::class, 'manage_coupon']);
    Route::post('admin/coupon/manage_coupon_process',[CouponController::class, 'manage_coupon_process'])->name('coupon.manage_coupon_process');
    Route::get('admin/coupon/status/{status}/{id}', [CouponController::class, 'status']);
    Route::get('admin/coupon/delete/{id}',[CouponController::class, 'delete']);


    // SIZE ROUTE

    Route::get('admin/size', [SizeController::class, 'index']);
    Route::get('admin/size/manage_size',[SizeController::class, 'manage_size']);
    Route::get('admin/size/manage_size/{id}',[SizeController::class, 'manage_size']);
    Route::post('admin/size/manage_size_process',[SizeController::class, 'manage_size_process'])->name('size.manage_size_process');
    Route::get('admin/size/status/{status}/{id}', [SizeController::class, 'status']);
    Route::get('admin/size/delete/{id}',[SizeController::class, 'delete']);

        // COLOR ROUTE
        Route::get('admin/color', [ColorController::class, 'index']);
        Route::get('admin/color/manage_color',[ColorController::class, 'manage_color']);
        Route::get('admin/color/manage_color/{id}',[ColorController::class, 'manage_color']);
        Route::post('admin/color/manage_color_process',[ColorController::class, 'manage_color_process'])->name('color.manage_color_process');
        Route::get('admin/color/status/{status}/{id}', [ColorController::class, 'status']);
        Route::get('admin/color/delete/{id}',[ColorController::class, 'delete']);

        // Brand ROUTE
        Route::get('admin/brand', [BrandController::class, 'index']);
        Route::get('admin/brand/manage_brand',[BrandController::class, 'manage_brand']);
        Route::get('admin/brand/manage_brand/{id}',[BrandController::class, 'manage_brand']);
        Route::post('admin/brand/manage_brand_process',[BrandController::class, 'manage_brand_process'])->name('brand.manage_brand_process');
        Route::get('admin/brand/status/{status}/{id}', [BrandController::class, 'status']);
        Route::get('admin/brand/delete/{id}',[BrandController::class, 'delete']);


        // PRODUCT ROUTE
        Route::get('admin/product', [ProductController::class, 'index']);
        Route::get('admin/product/manage_product',[ProductController::class, 'manage_product']);
        Route::get('admin/product/manage_product/{id}',[ProductController::class, 'manage_product']);
        Route::post('admin/product/manage_product_process',[ProductController::class, 'manage_product_process'])->name('product.manage_product_process');
        Route::get('admin/product/status/{status}/{id}', [ProductController::class, 'status']);
        Route::get('admin/product/delete/{id}',[ProductController::class, 'delete']);
        Route::get('admin/product/product_attri_delete/{paid}/{pid}',[ProductController::class, 'product_attri_delete']);
        Route::get('admin/product/product_image_delete/{piid}/{pid}',[ProductController::class, 'product_image_delete']);


        // Taxs ROUTE
        Route::get('admin/tax', [TaxController::class, 'index']);
        Route::get('admin/tax/manage_tax',[TaxController::class, 'manage_tax']);
        Route::get('admin/tax/manage_tax/{id}',[TaxController::class, 'manage_tax']);
        Route::post('admin/tax/manage_tax_process',[TaxController::class, 'manage_tax_process'])->name('tax.manage_tax_process');
        Route::get('admin/tax/status/{status}/{id}', [TaxController::class, 'status']);
        Route::get('admin/tax/delete/{id}',[TaxController::class, 'delete']);

        // Home Banner ROUTE
        Route::get('admin/banner', [HomeBannerController::class, 'index']);
        Route::get('admin/banner/manage_banner',[HomeBannerController::class, 'manage_banner']);
        Route::get('admin/banner/manage_banner/{id}',[HomeBannerController::class, 'manage_banner']);
        Route::post('admin/banner/manage_banner_process',[HomeBannerController::class, 'manage_banner_process'])->name('banner.manage_banner_process');
        Route::get('admin/banner/status/{status}/{id}', [HomeBannerController::class, 'status']);
        Route::get('admin/banner/delete/{id}',[HomeBannerController::class, 'delete']);


        // CUSTOMER ROUTE
        Route::get('admin/customer', [CustomerController::class, 'index']);
        Route::get('admin/customer/show/{id}',[CustomerController::class, 'show']);
        Route::get('admin/customer/status/{status}/{id}', [CustomerController::class, 'status']);

       // logout
    Route::get('admin/logout',[AdminController::class, 'logout'])->name('logout');
    Route::get('admin/updatepassword',[AdminController::class, 'updatepassword'])->name('updatepassword');


// Route::post('admin/form-submit', [AdminController::class, 'formSubmit'])->name('f.submit');
// Route example with prefix
/*
Route::get('/item', [ItemController::class, 'index']);//list of item
Route::prefix('/item')->group(function(){
    Route::post('/store',[ItempController::class, 'store']);
    Route::put('/{id}',[ItempController::class, 'update']);
    Route::delete('/{id}',[ItempController::class, 'destroy']);
});
*/

}); 


