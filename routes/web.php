<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\LogoutController;

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

Route::get('/', [FrontendController::class, 'welcome'])->name('index');

Route::get('/seller-register', [RegisterController::class, 'showSellerRegistrationForm'])->name('seller.register');
Route::post('/user-login', [LoginController::class, 'customlogin'])->name('custom.login');
Route::post('/user-register', [RegisterController::class, 'customregister'])->name('custom.register');

Route::get('/search-result', [FrontendController::class, 'searchresult'])->name('search.result');

Route::get('/products-for-category/{id}', [FrontendController::class, 'categorywiseproduct']);
Route::get('/products-for-category-by-brand', [FrontendController::class, 'categorywisebrandproduct']);

Route::get('/products-for-brand/{id}', [FrontendController::class, 'brandwiseproduct']);
Route::get('/products-for-brand-by-category', [FrontendController::class, 'brandwisecategoryproduct']);

Route::get('/products-store', [FrontendController::class, 'productstore'])->name('product.store');

Route::get('/contact-us', [FrontendController::class, 'contactus'])->name('contact.us');

Route::get('/about-us', [FrontendController::class, 'aboutus'])->name('about.us');

Route::get('/product-details/{id}', [FrontendController::class, 'productdetail']);

Route::post('/subscribe/us', [FrontendController::class, 'subscribeus'])->name('subscribe.us');
Route::get('/unsubscribe/us/{email}', [FrontendController::class, 'unsubscribeus'])->name('unsubscribe.us');

Route::post('/send/message', [FrontendController::class, 'sendmessage'])->name('send.message');

Route::get('/privacy-policy', [FrontendController::class, 'privacypolicy'])->name('privacy.policy');

Route::get('/hot-deal/{id}', [FrontendController::class, 'hotdeal']);

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {

	Route::middleware(['admin'])->group(function () {
		Route::get('/admin-home', [HomeController::class, 'adminindex'])->name('admin.home');

		Route::get('/add-brand', [AdminController::class, 'addbrand'])->name('add.brand');
		Route::post('/store-brand', [AdminController::class, 'storebrand'])->name('store.brand');
		Route::get('/all-brands', [AdminController::class, 'allbrand'])->name('all.brand');
		Route::get('/edit-brand/{id}', [AdminController::class, 'editbrand']);
		Route::patch('/update-brand/{id}', [AdminController::class, 'updatebrand']);
		Route::delete('/delete-brand/{id}', [AdminController::class, 'deletebrand']);

		Route::get('/add-category', [AdminController::class, 'addcategory'])->name('add.category');
		Route::post('/store-category', [AdminController::class, 'storecategory'])->name('store.category');
		Route::get('/all-categories', [AdminController::class, 'allcategory'])->name('all.category');
		Route::get('/edit-category/{id}', [AdminController::class, 'editcategory']);
		Route::patch('/update-category/{id}', [AdminController::class, 'updatecategory']);
		Route::delete('/delete-category/{id}', [AdminController::class, 'deletecategory']);

		Route::get('/approve-sellers', [AdminController::class, 'notapprovedseller'])->name('approve.seller');
		Route::patch('/approve-seller/{id}', [AdminController::class, 'approveseller']);
		Route::get('/all-sellers', [AdminController::class, 'allseller'])->name('all.seller');
		Route::patch('/disapprove-seller/{id}', [AdminController::class, 'disapproveseller']);

		Route::get('/admin/change-email', [ProfileController::class, 'adminchangeemail'])->name('admin.change.email');
		Route::get('/admin/change-password', [ProfileController::class, 'adminchangepassword'])->name('admin.change.password');
		Route::get('/admin/change-picture', [ProfileController::class, 'adminchangepicture'])->name('admin.change.picture');

		Route::get('/processing-withdraws', [AdminController::class, 'adminprocessingwithdraw'])->name('admin.processing.withdraw');
		Route::get('/complete-withdraw/{id}', [AdminController::class, 'admincompletewithdraw']);
		Route::patch('/complete-withdraw/{id}', [AdminController::class, 'admincompletewithdraw2']);
		Route::get('/completed-withdraws', [AdminController::class, 'admincompletedwithdraw'])->name('admin.completed.withdraw');
		Route::get('/admin/view-withdraw/{id}', [AdminController::class, 'adminviewwithdraw']);

		Route::get('/add-hot-deal', [AdminController::class, 'addhotdeal'])->name('add.hot.deal');
		Route::post('/store-hot-deal', [AdminController::class, 'storehotdeal'])->name('store.hot.deal');
		Route::get('/all-hot-deals', [AdminController::class, 'allhotdeal'])->name('all.hot.deal');
		Route::get('/edit-hot-deal/{id}', [AdminController::class, 'edithotdeal']);
		Route::patch('/update-hot-deal/{id}', [AdminController::class, 'updatehotdeal']);
	});

	Route::middleware(['seller'])->group(function () {
		Route::get('/not-approved/seller-home', [HomeController::class, 'notapprovedsellerindex'])->name('not.approved.seller.home')->middleware('not.approved');

		Route::middleware(['approved'])->group(function () {
			Route::get('/seller-home', [HomeController::class, 'sellerindex'])->name('seller.home');

			Route::get('/add-shop', [SellerController::class, 'addshop'])->name('add.shop');
			Route::post('/store-shop', [SellerController::class, 'storeshop'])->name('store.shop');
			Route::get('/all-shops', [SellerController::class, 'allshop'])->name('all.shop');
			Route::get('/edit-shop/{id}', [SellerController::class, 'editshop']);
			Route::patch('/update-shop/{id}', [SellerController::class, 'updateshop']);
			Route::delete('/delete-shop/{id}', [SellerController::class, 'deleteshop']);

			Route::get('/add-product', [SellerController::class, 'addproduct'])->name('add.product');
			Route::post('/store-product', [SellerController::class, 'storeproduct'])->name('store.product');
			Route::get('/all-products', [SellerController::class, 'allproduct'])->name('all.product');
			Route::get('/edit-product/{id}', [SellerController::class, 'editproduct']);
			Route::patch('/update-product/{id}', [SellerController::class, 'updateproduct']);
			Route::delete('/delete-product/{id}', [SellerController::class, 'deleteproduct']);

			Route::get('/seller/processing-orders', [SellerController::class, 'sellerprocessingorder'])->name('seller.processing.order');
			Route::get('/seller/completed-orders', [SellerController::class, 'sellercompletedorder'])->name('seller.completed.order');
			Route::get('/seller/cancelled-orders', [SellerController::class, 'sellercanceledorder'])->name('seller.canceled.order');
			Route::get('/seller/view-order/{id}', [SellerController::class, 'sellervieworder']);
			Route::patch('/process-order/{id}', [SellerController::class, 'processorder']);
			Route::patch('/package-order/{id}', [SellerController::class, 'packageorder']);
			Route::patch('/ship-order/{id}', [SellerController::class, 'shiporder']);
			Route::patch('/deliver-order/{id}', [SellerController::class, 'deliverorder']);

			Route::get('/seller/change-email', [ProfileController::class, 'sellerchangeemail'])->name('seller.change.email');
			Route::get('/seller/change-password', [ProfileController::class, 'sellerchangepassword'])->name('seller.change.password');
			Route::get('/seller/change-picture', [ProfileController::class, 'sellerchangepicture'])->name('seller.change.picture');

			Route::get('/request-a-withdraw', [SellerController::class, 'sellerrequestwithdraw'])->name('seller.request.withdraw');
			Route::post('/request-withdraw/{total}', [SellerController::class, 'sellerrequestwithdraw2'])->name('request.withdraw');
			Route::get('/all-withdraws', [SellerController::class, 'sellerallwithdraw'])->name('seller.all.withdraw');
			Route::get('/view-withdraw/{id}', [SellerController::class, 'sellerviewwithdraw']);
		});
	});

	Route::middleware(['buyer'])->group(function () {
		Route::get('/home', [HomeController::class, 'index'])->name('buyer.home');

		Route::post('/add-to-wishlist/{id}', [FrontendController::class, 'addtowishlist']);
		Route::get('/show-wishlist', [FrontendController::class, 'showwishlist'])->name('show.wishlist');
		Route::delete('/remove-from-wishlist/{id}', [FrontendController::class, 'removefromwishlist']);

		Route::post('/add-to-cart/{id}', [FrontendController::class, 'addtocart']);
		Route::get('/view-cart', [FrontendController::class, 'viewcart'])->name('view.cart');
		Route::patch('/update-cart/{id}', [FrontendController::class, 'updatecart']);
		Route::delete('/remove-from-cart/{id}', [FrontendController::class, 'removefromcart']);

		Route::post('/order-checkout', [FrontendController::class, 'ordercheckout'])->name('order.checkout');
		Route::get('/processing-orders', [FrontendController::class, 'buyerprocessingorder'])->name('buyer.processing.order');
		Route::get('/completed-orders', [FrontendController::class, 'buyercompletedorder'])->name('buyer.completed.order');
		Route::get('/cancelled-orders', [FrontendController::class, 'buyercanceledorder'])->name('buyer.canceled.order');
		Route::get('/view-order/{id}', [FrontendController::class, 'buyervieworder']);
		Route::delete('/cancel-order/{id}', [FrontendController::class, 'cancelorder']);

		Route::get('/pending-reviews', [FrontendController::class, 'buyerpendingreview'])->name('buyer.pending.review');
		Route::post('/submit/review/{id}', [FrontendController::class, 'submitreview']);
		Route::get('/reviewed-orders', [FrontendController::class, 'buyerreviewedorder'])->name('buyer.reviewed.order');

		Route::post('/pay-order/{total}', [SslCommerzPaymentController::class, 'payorder']);

		Route::get('/change-email', [ProfileController::class, 'buyerchangeemail'])->name('buyer.change.email');
		Route::get('/change-password', [ProfileController::class, 'buyerchangepassword'])->name('buyer.change.password');
		Route::get('/change-picture', [ProfileController::class, 'buyerchangepicture'])->name('buyer.change.picture');
	});

	Route::patch('/{type}/update-email', [ProfileController::class, 'updateemail'])->name('update.email');
	Route::patch('/{type}/update-password', [ProfileController::class, 'updatepassword'])->name('update.password');
	Route::patch('/{type}/update-picture', [ProfileController::class, 'updatepicture'])->name('update.picture');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('custom_logout');
});

Route::fallback([FrontendController::class, 'pagenotfound']);
