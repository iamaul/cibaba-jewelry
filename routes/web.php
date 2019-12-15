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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
