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

Route::get('/', 'PagesController@root')->name('root');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth', 'verified']], function() {
    //收件地址列表
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');

    //收件地址編輯頁面
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');

    //收件地址編輯頁面提交
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');

    //進入收件地址編輯頁面
    Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');

    //儲存編輯後的收件地址
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
});
