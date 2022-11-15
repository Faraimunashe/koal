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

    Route::get('/admin/cattle/{book_id}', 'App\Http\Controllers\admin\CattleController@index')->name('admin-cattle');
    Route::get('/admin-cattle/{cattle_id}', 'App\Http\Controllers\admin\CattleController@cow')->name('admin-cow');
    Route::get('/admin/cattle-diagnise', 'App\Http\Controllers\admin\CattleController@diagnise')->name('admin-diagnosis-cattle');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');
    Route::get('/get-quote', 'App\Http\Controllers\user\DashboardController@quote')->name('user-quote');

    Route::get('/payments', 'App\Http\Controllers\user\TransactionController@index')->name('user-transactions');

    Route::get('/create-booking', 'App\Http\Controllers\user\BookingController@index')->name('user-create-booking');
    Route::get('/add-cattle', 'App\Http\Controllers\user\BookingController@cow')->name('user-create-cow');

});

require __DIR__.'/auth.php';
