<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');
//Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');
//Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');
//Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');
//Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');
//Route::post(
//    'generator_builder/generate-from-file',
//    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
//)->name('io_generator_builder_generate_from_file');

Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->middleware('verified');
Route::post('/home','HomeController@post')->middleware('verified');
Route::post('/reward/shareFb','HomeController@shareFb')->middleware('verified');
Route::resource('event', 'CollectController')->middleware(['verified']);
Route::get('/donate','Donate\DonateController@getDonate')->name('donate')->middleware('verified');
Route::resource('transactions', 'Diablo2\TransactionController')->middleware(['verified']);
Route::resource('kill', 'Diablo2\KillController')->middleware(['highadmin', 'verified']);
Route::resource('bnets', 'Diablo2\BNETController')->middleware(['highadmin', 'verified']);
Route::resource('users', 'UserController')->middleware(['highadmin', 'verified']);
Route::resource('trades', 'TradeController')->middleware(['highadmin', 'verified']);
Route::resource('tradeHistories', 'TradeHistoryController')->middleware(['highadmin', 'verified']);
Route::resource('tradeAccounts', 'TradeAccountController')->middleware(['highadmin', 'verified']);
Route::get('/redirect/{social}', 'SocialAuthController@redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');

Route::get('/checkout-nl/success', 'Checkout\NganLuong\CheckoutController@success')->name('checkoutNl.success');
Route::post('/checkout-nl', 'Checkout\NganLuong\CheckoutController@postCheckout')->name('checkoutNl.ngan-luong');


