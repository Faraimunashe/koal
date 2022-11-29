<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');
Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->middleware(['auth'])->name('profile');
Route::post('/change-password', 'App\Http\Controllers\ProfileController@change')->middleware(['auth'])->name('change-password');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    Route::get('/admin/transactions', 'App\Http\Controllers\admin\TransactionController@index')->name('admin-transactions');
    Route::get('/admin/transaction-report', 'App\Http\Controllers\admin\TransactionController@report')->name('admin-transaction-report');

    Route::get('/admin/abattoirs', 'App\Http\Controllers\admin\AbattoirController@index')->name('admin-abattoirs');
    Route::post('/admin/abattoir-add', 'App\Http\Controllers\admin\AbattoirController@add')->name('admin-add-abattoir');
    Route::post('/admin/abattoir-edit', 'App\Http\Controllers\admin\AbattoirController@edit')->name('admin-edit-abattoir');

    Route::get('/admin/diagnosis', 'App\Http\Controllers\admin\DiagnosisController@index')->name('admin-diagnosis');
    Route::post('/admin/diagnosis-add', 'App\Http\Controllers\admin\DiagnosisController@add')->name('admin-add-diagnosis');

    Route::get('/admin/bookings', 'App\Http\Controllers\admin\BookingController@index')->name('admin-bookings');
    Route::post('/admin/booking-reply', 'App\Http\Controllers\admin\BookingController@reply')->name('admin-reply-booking');
    Route::post('/admin/delete-booking', 'App\Http\Controllers\admin\BookingController@delete')->name('admin-delete-booking');

    Route::get('/admin/quotations', 'App\Http\Controllers\admin\QuoteController@index')->name('admin-quotes');
    Route::post('/admin/add-quote', 'App\Http\Controllers\admin\QuoteController@add')->name('admin-add-quote');

    Route::get('/admin/prices', 'App\Http\Controllers\admin\PriceController@index')->name('admin-prices');
    Route::post('/admin/update', 'App\Http\Controllers\admin\PriceController@update')->name('admin-update-price');

    Route::get('/admin/cattle/{book_id}', 'App\Http\Controllers\admin\CattleController@index')->name('admin-cattle');
    Route::get('/admin-cattle/{cattle_id}', 'App\Http\Controllers\admin\CattleController@cow')->name('admin-cow');
    Route::post('/admin/cattle-diagnise', 'App\Http\Controllers\admin\CattleController@diagnise')->name('admin-diagnosis-cattle');


    Route::get('/admin/notices', 'App\Http\Controllers\admin\NoticeController@index')->name('admin-notices');
    Route::post('/admin/add-notice', 'App\Http\Controllers\admin\NoticeController@add')->name('admin-add-notice');
    Route::post('/admin/delete-notice', 'App\Http\Controllers\admin\NoticeController@delete')->name('admin-delete-notice');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');
    Route::post('/get-quote', 'App\Http\Controllers\user\DashboardController@quote')->name('user-get-quote');

    Route::get('/quotations', 'App\Http\Controllers\user\QuoteController@index')->name('user-quotes');

    Route::get('/notices', 'App\Http\Controllers\user\NoticeController@index')->name('user-notices');

    Route::get('/payments', 'App\Http\Controllers\user\TransactionController@index')->name('user-transactions');
    Route::post('/make-payment', 'App\Http\Controllers\user\TransactionController@pay')->name('user-pay');

    Route::get('/create-booking', 'App\Http\Controllers\user\BookingController@index')->name('user-create-booking');
    Route::get('/add-cattle', 'App\Http\Controllers\user\BookingController@cow')->name('user-create-cow');
    Route::post('/add-book', 'App\Http\Controllers\user\BookingController@add')->name('user-add-book');
    Route::post('/add-cow', 'App\Http\Controllers\user\BookingController@add_cow')->name('user-add-cow');
    Route::get('/booking-details/{booking_id}', 'App\Http\Controllers\user\BookingController@details')->name('user-booking-details');

    Route::get('/user/diagnosis', 'App\Http\Controllers\user\DiagnosisController@index')->name('user-diagnosis');
});

require __DIR__.'/auth.php';
