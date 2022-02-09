<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\RentNumberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryServiceProviderController;
use App\Http\Controllers\adminOperationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FavouriteController;

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
Auth::routes();

/*Front Routes*/
Route::get('/', [FrontController::class, 'index']);

/*User Routes*/
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/editprofile', [UserController::class, 'editprofile'])->name('edit.profile');
Route::post('/editprofile', [UserController::class, 'updateprofile'])->name('update.profile');
Route::get('/rent-number', [RentNumberController::class, 'Countries'])->name('rent_number');
Route::get('/my-number', [RentNumberController::class, 'my_number'])->name('my_number')->middleware('auth');
Route::get('/history', [UserController::class, 'history'])->name('history')->middleware('auth');

/*support mail*/
Route::get('/support', [UserController::class, 'support'])->name('support');
Route::post('/support', [UserController::class, 'email'])->name('support.email');

/*javascript Routes*/
Route::get('/countrycode/{code}', [FrontController::class, 'country_code']);
Route::get('/confirmnumber', [FrontController::class, 'confirm_number']);
Route::get('/servicecode', [FrontController::class, 'service_code']);
Route::get('/cancelnumber', [FrontController::class, 'cancel_number']);
Route::get('/getsms', [FrontController::class, 'get_sms']);
Route::get('/updatebalance', [FrontController::class, 'update_balance']);
Route::get('/getservice/{code}', [RentNumberController::class, 'get_service']);
Route::get('/rentnumber', [RentNumberController::class, 'rent_number']);
Route::get('/activerent/{id}', [RentNumberController::class, 'rent_number_activation']);
Route::get('/prolongrent/{id}', [RentNumberController::class, 'rent_number_prolongation']);
Route::get('/cancelrent/{id}', [RentNumberController::class, 'rent_number_remove']);
Route::get('/loadprolongmodal/{id}', [RentNumberController::class, 'loadprolongmodal']);
Route::get('/getsmsrent/{id}', [RentNumberController::class, 'rent_number_sms']);

/*Admin Routes*/
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('is_admin');

Route::get('/admin/user-list', [AdminController::class, 'userList'])->name('admin.user-list')->middleware('is_admin');
Route::get('/admin/user-list/{id}', [AdminController::class, 'destroy'])->name('delete.user-list')->middleware('is_admin');

/*javascript*/
Route::get('admin/user-list/status/{id}/{status}', [AdminController::class, 'userstatus'])->middleware('is_admin');

/*------------------------------------Country-----------------------------------------------------*/

Route::get('/admin/country-list', [CountryController::class, 'index'])->name('admin.country-list')->middleware('is_admin');

Route::get('/admin/country-add', [CountryController::class, 'create'])->name('admin.country-add')->middleware('is_admin');

Route::post('/admin/country-store', [CountryController::class, 'store'])->name('admin.country-store')->middleware('is_admin');

/*------------------------------------Country Edit part---------------------------------------------*/

Route::get('/admin/country/edit-country/{id}',[CountryController::class, 'edit'])->name('admin.edit-country');
Route::put('/admin/country/country-up/{id}',[CountryController::class, 'update'])->name('admin.country-up');

/*------------------------------------Country del part------------------------------------------*/
Route::get('admin/country/country-del/{id}', [CountryController::class, 'destroy'])->name('admin.country-del');
/*------------------------------------Country Status part-------------------------------------------*/
Route::get('/admin/country/country-status/{status}/{id}', [CountryController::class, 'status'])->name('admin.country-status');


/*-----------------------------------------------------Service part------------------------------*/

Route::get('/admin/service-list', [ServiceController::class, 'index'])->name('admin.service-list')->middleware('is_admin');

Route::get('/admin/service-add', [ServiceController::class, 'create'])->name('admin.service-add')->middleware('is_admin');

Route::post('/admin/service-store', [ServiceController::class, 'store'])->name('admin.service-store')->middleware('is_admin');

/*------------------------------------Service Edit part------------------------------------------*/

Route::get('/admin/service/edit-service/{id}',[ServiceController::class, 'edit'])->name('admin.edit-service');
Route::put('/admin/service/service-up/{id}',[ServiceController::class, 'update'])->name('admin.service-up');

/*------------------------------------Country del part----------------------------------------*/
Route::get('admin/service/service-del/{id}', [ServiceController::class, 'destroy'])->name('admin.service-del');

Route::get('/admin/service/service-status/{status}/{id}', [ServiceController::class, 'status'])->name('admin.service-status');
/*------------------------------------------------------------------------------------------------*/

/*-------------------------------------Start Country Service Provider----------------------------*/

Route::get('admin/country-service-provider/add', [CountryServiceProviderController::class, 'create'])->name('admin.c-s-p-add')->middleware('is_admin');

Route::get('admin/country-service-provider/list', [CountryServiceProviderController::class, 'index'])->name('admin.c-s-p-list')->middleware('is_admin');

Route::post('/admin/country-service-provider/store', [CountryServiceProviderController::class, 'store'])->name('admin.c-s-p-store')->middleware('is_admin');
Route::get('/admin/country-service-provider/edit/{id}', [CountryServiceProviderController::class, 'edit'])->name('admin.c-s-p-edit')->middleware('is_admin');
Route::put('/admin/country-service-provider/edit/{id}', [CountryServiceProviderController::class, 'update'])->name('admin.c-s-p-update')->middleware('is_admin');
Route::get('/admin/country-service-provider/delete/{id}', [CountryServiceProviderController::class, 'destroy'])->name('admin.c-s-p-destroy')->middleware('is_admin');

/*--------------------------End Country Service Provider------------------------------------------*/

/*-------------------------------------Start Admin Operation----------------------------*/

Route::get('admin/operation/add', [adminOperationController::class, 'create'])->name('admin.operation-add')->middleware('is_admin');

Route::get('admin/operation/list', [adminOperationController::class, 'index'])->name('admin.operation-list')->middleware('is_admin');

Route::post('/admin/operation/store', [adminOperationController::class, 'store'])->name('admin.operation-store')->middleware('is_admin');

Route::get('admin/operation/operationView', [adminOperationController::class, 'operationView'])->name('admin.operationView')->middleware('is_admin');

Route::post('/admin/operation/operationApiStore', [adminOperationController::class, 'operationApiStore'])->name('admin.operationApiStore')->middleware('is_admin');

Route::post('/admin/operation/operationPriceStore', [adminOperationController::class, 'operationPriceStore'])->name('admin.operationPriceStore')->middleware('is_admin');

/*------------------------------------Admin Operation del part------------------------------------------*/
Route::get('admin/operation/operation-del/{id}', [adminOperationController::class, 'destroy'])->name('admin.operation-del');

/*--------------------------End Admin Operation------------------------------------------*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*payment gateway route*/
Route::match(['get', 'post'], '/payments/crypto/pay', Victorybiz\LaravelCryptoPaymentGateway\Http\Controllers\CryptoPaymentController::class)->name('payments.crypto.pay');
Route::post('/payments/crypto/callback', [App\Http\Controllers\PaymentController::class, 'callback'])->withoutMiddleware(['web', 'auth']);
Route::get('payment', [PaymentController::class, 'index'])->name('payment');
Route::get('addpayment', [PaymentController::class, 'create'])->name('add.payment');

/*coinbase payment route*/
Route::get('addcryptopayment', [PaymentController::class, 'coinbase'])->name('add.cryptopayment');

/*Footer route*/
Route::get('/termsandconditions', [FrontController::class, 'terms'])->name('terms');
Route::get('/privacyandpolicy', [FrontController::class, 'privacy'])->name('privacy');
Route::get('/aboutus', [FrontController::class, 'about'])->name('about');

/*service favourite route*/
Route::get('/favourite/{service}', [FavouriteController::class, 'index'])->name('fav')->middleware('auth');

/*User history*/
Route::get('admin/user/history/{id}', [AdminController::class, 'history'])->name('admin.user-history')->middleware('is_admin');