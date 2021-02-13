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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function() {
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.post');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Auth\AdminController@index')->name('admin.dashboard');

    Route::get('/customers/list', 'Auth\AdminController@listCustomer')->name('admin.customer');
    Route::get('/customers/add', 'Auth\AdminController@addCustomer')->name('admin.customer.tambah');
    Route::post('/customers/add', 'Auth\AdminController@addPostCustomer')->name('admin.customer.post');

    Route::get('/kavling/list', 'Auth\AdminController@listKavling')->name('admin.kavling');
    Route::get('/kavling/add', 'Auth\AdminController@addKavling')->name('admin.kavling.tambah');
    Route::post('/kavling/add', 'Auth\AdminController@addPostKavling')->name('admin.kavling.post');

    Route::get('/blog/list', 'Auth\AdminController@listKavling')->name('admin.kavling');
    Route::get('/blog/add', 'Auth\AdminController@addKavling')->name('admin.kavling.tambah');
    Route::post('/blog/add', 'Auth\AdminController@addPostKavling')->name('admin.kavling.post');

    Route::get('/penjualan/list', 'Auth\AdminController@listPenjualan')->name('admin.penjualan');
    Route::get('/penjualan/add', 'Auth\AdminController@addPenjualan')->name('admin.penjualan.tambah');
    Route::post('/penjualan/add', 'Auth\AdminController@addPostPenjualan')->name('admin.penjualan.post');

    Route::get('/tagihan/list', 'Auth\AdminController@listTagihan')->name('admin.tagihan');
    // Route::get('/tagihan/add', 'Auth\AdminController@addTagihan')->name('admin.tagihan.tambah');
    Route::post('/tagihan/add', 'Auth\AdminController@addTagihan')->name('admin.tagihan.post');
}) ;

Route::get('/harga', 'Auth\AdminController@getData')->name('getHarga');
Route::get('/transaksi', 'Auth\AdminController@getTransaksi')->name('getTransaksi');
