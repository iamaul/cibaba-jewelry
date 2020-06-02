<?php

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

Route::get('/', 'HomeController@index');
Route::get('/product/detail/{product}', 'ProductController@show')->name('product-detail');
Route::get('/catalog/category/{category}', 'CatalogController@index')->name('catalog');
Route::get('/promo', 'PromoController@index')->name('promo');

Route::get('/shopping/cart', 'CartController@index')->name('cart');
Route::post('/shopping/add/cart/{id}/{name}/{price}', 'CartController@store')->name('addToCart');
Route::delete('/shopping/destroy/cart/{product}', 'CartController@destroy')->name('removeCartItem');
Route::patch('/shopping/update/cart/qty/{product}', 'CartController@update')->name('updateQty');

Route::get('/shopping/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/shopping/checkout/complete', 'CheckoutController@completeOrder')->name('complete');
Route::post('/shopping/checkout/payment', 'CheckoutController@store')->name('payment');
Route::post('/shopping/checkout/notification', 'CheckoutController@notification')->name('notification');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
