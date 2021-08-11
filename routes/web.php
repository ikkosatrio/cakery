<?php
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

Route::get('/migrate', function() {

    Artisan::call('migrate');
    return "Migration success!";

});

Route::get('/migratefull', function() {

    Artisan::call('migrate:fresh --seed');
    return "Migration FULL success!";

});


//ARTISAN CALL
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cleared!";
});


//ADMIN
Route::get('/admin/login', 'Auth\LoginController@showLoginForm');
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'Admin\DashboardController@index')->name('admin.index');
    Route::get('/admin/not-found', 'Admin\DashboardController@notFound')->name('admin-not-found');
    Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('admin/config', 'Admin\ConfigController',['as' => 'admin']);
    Route::resource('admin/profile', 'Admin\ProfileController',['as' => 'admin']);
    Route::resource('admin/slide', 'Admin\SlideController',['as' => 'admin']);
    Route::resource('admin/user', 'Admin\UserController',['as' => 'admin']);
    Route::resource('admin/group', 'Admin\GroupController',['as' => 'admin']);
    Route::resource('admin/testimoni', 'Admin\TestimoniController',['as' => 'admin']);
    Route::resource('admin/faq', 'Admin\FaqController',['as' => 'admin']);
    Route::resource('admin/event', 'Admin\EventController',['as' => 'admin']);
    Route::resource('admin/news', 'Admin\NewsController',['as' => 'admin']);
    Route::resource('admin/news-category', 'Admin\NewsCategoryController',['as' => 'admin']);

    Route::get('/admin/order/print/{id}', 'Admin\OrderController@printinv')->name('admin.order.print');
    Route::get('/admin/order/changestatus/{id}', 'Admin\OrderController@ChangeStatus')->name('admin.order.status');
    Route::resource('admin/order', 'Admin\OrderController',['as' => 'admin']);



    Route::resource('admin/product', 'Admin\ProductController',['as' => 'admin']);
    Route::resource('admin/product-category', 'Admin\ProductCategoryController',['as' => 'admin']);

    Route::resource('admin/asesor', 'Admin\AsesorController',['as' => 'admin']);
    Route::resource('admin/certificate-holder', 'Admin\CertificateHolderController',['as' => 'admin']);
    Route::resource('admin/kompetensi', 'Admin\KompetensiController',['as' => 'admin']);
    Route::resource('admin/kompetensi.detail', 'Admin\KompetensiDetailController',['as' => 'admin']);

    Route::resource('admin/gallery', 'Admin\GalleryController',['as' => 'admin']);
    Route::resource('admin/gallery-category', 'Admin\GalleryCategoryController',['as' => 'admin']);
    Route::resource('admin/appointment', 'Admin\AppointmentController',['as' => 'admin']);
    Route::resource('admin/client', 'Admin\ClientController',['as' => 'admin']);
    Route::resource('admin/home', 'Admin\HomeController',['as' => 'admin']);
    Route::resource('admin/cakemenu', 'Admin\CakeMenuController',['as' => 'admin']);
    Route::resource('admin/confection', 'Admin\ConfectionController',['as' => 'admin']);

    Route::resource('admin/visi-misi', 'Admin\VisiMisiController',['as' => 'admin']);
    Route::resource('admin/struktur', 'Admin\StrukturController',['as' => 'admin']);
    Route::resource('admin/tempat', 'Admin\TempatController',['as' => 'admin']);
    Route::resource('admin/logo', 'Admin\LogoController',['as' => 'admin']);
    Route::resource('admin/contoh-sertifikat', 'Admin\ContohSertifikatController',['as' => 'admin']);
    Route::resource('admin/regulasi', 'Admin\RegulasiController',['as' => 'admin']);
    Route::resource('admin/contact-message', 'Admin\ContactMessageController',['as' => 'admin']);
});

Route::get('/', 'User\HomeController@index')->name('index');
Route::get('/cakemenu', 'User\PagesController@cakemenu')->name('cakemenu');
Route::get('/confection', 'User\PagesController@confection')->name('confection');
Route::get('/faq', 'User\PagesController@faq')->name('faq');
Route::get('/contact', 'User\PagesController@contact')->name('contact');

Route::get('/shop', 'User\ShopController@index')->name('shop');
Route::get('/shop/testemail', 'User\ShopController@testemail')->name('shop.testemail');
Route::post('/shop/paymentpaypal', 'User\ShopController@savePaymentPaypal')->name('shop.paymentpaypal');
Route::post('/shop/addtocart', 'User\ShopController@addtocart')->name('shop.addtocart');
Route::post('/shop/getcity', 'User\ShopController@getCity')->name('shop.getcity');
Route::post('/shop/processcheckout', 'User\ShopController@processCheckout')->name('shop.processcheckout');


Route::get('/product', 'User\ProductController@index')->name('product');
Route::get('/product/{slug}', 'User\ProductController@detail')->name('product.detail');

Route::get('/shop/checkout', 'User\ShopController@checkout')->name('shop.checkout');

Route::post('main/sendconsult', 'User\HomeController@sendconsult')->name('user.sendconsult');




//OTHER
Auth::routes();
