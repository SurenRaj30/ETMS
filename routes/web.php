<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Provider\ServiceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\FullCalenderController;

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


Route::get('/home', function () {
    return view('welcome');
});

Route::get('fullcalender/{id}', [FullCalenderController::class, 'index']);

//test datatables

Route::get('test', [TouristController::class, 'showList']);


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe', [StripeController::class, 'stripePost'])->name('payment');

//tourist routes
Route::group(['prefix'=>'tourist', 'middleware'=>'auth'], function(){
    
    //Route::get('/bookingForm', [BookingController::class, 'form']);
    Route::get('/main', [BookingController::class, 'main']);
    Route::get('/bookForm/{id}', [BookingController::class, 'form']);
    Route::get('/view/{id}', [BookingController::class, 'view']);
    Route::post('/createBooking', [BookingController::class, 'create'])
    ->name('createBooking');

    Route::get('viewBooking/{id}', [TouristController::class, 'viewBooking']);
    Route::get('list', [TouristController::class, 'bookList'])->name('users.index');
    Route::post('rating', [BookingController::class, 'rating'])->name('rating');

});

//admin routes

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
    Route::get('dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

    //approve provider
    Route::get('/pendingList', [AdminController::class, 'pendingList'])->name('pendingList');
    Route::get('/approve/{id}', [AdminController::class, 'approve']);
    Route::get('/reject/{id}', [AdminController::class, 'rejectForm']);
    Route::post('/reject/{id}', [AdminController::class, 'processReject']);
    Route::get('/viewProvider/{id}', [AdminController::class, 'view']);

    //approve service
    Route::get('/pendingService', [AdminController::class, 'pendingService'])->name('pendingService');
    Route::get('/approveService/{id}', [AdminController::class, 'approveService']);
    Route::get('/viewService/{id}', [AdminController::class, 'viewService']);
    Route::get('/rejectService/{id}', [AdminController::class, 'showRejectForm']);
    Route::post('/processReject/{id}', [AdminController::class, 'processRejectForm']);
});

//register provider to temp table
Route::get('registerProvider', [RegisterController::class, 'providerForm'])
->name('registerProvider');

Route::post('createProvider', [RegisterController::class, 'createProvider'])
->name('createProvider');

//custom login for approved provider
Route::get('/login/s_provider', [LoginController::class, 'providerLoginForm'])
->name('providerLoginForm');

Route::post('/login/s_provider', [LoginController::class, 'providerLogin']);

//provider routes
Route::group(['prefix'=>'provider', 'middleware'=>'auth:s_provider'], function(){

    //provider manager
    Route::get('/s_provider', [ProviderController::class, 'index']);

    Route::get('dashboard', [ProviderController::class, 'index'])
    ->name('provider.dashboard');

    Route::get('profile', [ProviderController::class, 'profile'])->name('provider.profile');
    Route::get('profileUpdate', [ProviderController::class, 'profileUpdateForm']);
    Route::post('profileUpdate/{id}', [ProviderController::class, 'profileUpdate'])->name('updateProfile');
  
    Route::get('/search', [ServiceController::class, 'search'])->name('search');

    Route::get('/search', [ProviderController::class, 'search'])->name('searchBooking');

    //registered service manager

    Route::get('registerServiceForm', [ServiceController::class, 'create'])
    ->name('registerServiceForm');

    Route::get('serviceList', [ServiceController::class, 'index'])->name('serviceList');

    Route::post('registerServiceForm', [ServiceController::class, 'store'])
    ->name('registerServiceForm');

    Route::get('show/{id}', [ServiceController::class, 'show'])
    ->name('regServiceShow');

    Route::get('edit/{id}', [ServiceController::class, 'edit'])
    ->name('editService');

    Route::post('update/{id}', [ServiceController::class, 'update'])
    ->name('updateService');

    Route::get('delete/{id}', [ServiceController::class, 'destroy']);

    //manage Booking

    Route::get('bookList', [ProviderController::class, 'bookList'])->name('bookList');
    Route::get('viewBooking/{id}', [ProviderController::class, 'viewBooking']);
    Route::post('accept/{id}', [ProviderController::class, 'accept']);
    //reject booking
    Route::get('rejectBooking/{id}', [ProviderController::class, 'rejectBooking']);

});

//test chart

Route::get('/chart1', function () {
    return view('chart');
});


Route::get('/chart', [ChartController::class, '_invoke']);

//test general homepage

Route::get('/stripe1', function() {

    return view('paymentGate.stripe1');
});


//tourist interfaces

