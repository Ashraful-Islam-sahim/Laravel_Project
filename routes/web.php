<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix' =>  'admin'], function(){
   Route::get('/dashboard', 'App\Http\Controllers\Backend\pagescontroller@index')->name('dashboard');
// Brand route................................................
Route::group(['prefix' => 'brand'], function () {
   Route::get('/manage', 'App\Http\Controllers\Backend\BrandController@index')->name('brand.manage');
   Route::get('/create', 'App\Http\Controllers\Backend\BrandController@create')->name('brand.create');
   Route::post('/store', 'App\Http\Controllers\Backend\BrandController@store')->name('brand.store');
   Route::get('/edit/{id}', 'App\Http\Controllers\Backend\BrandController@edit')->name('brand.edit');
   Route::post('/update/{id}', 'App\Http\Controllers\Backend\BrandController@update')->name('brand.update');
   Route::get('/delete/{id}', 'App\Http\Controllers\Backend\BrandController@destroy')->name('brand.destroy');
});

// Category route.....................................................
Route::group(['prefix' => 'category'], function () {
   Route::get('/manage', 'App\Http\Controllers\Backend\CategoryController@index')->name('category.manage');
   Route::get('/create', 'App\Http\Controllers\Backend\CategoryController@create')->name('category.create');
   Route::post('/store', 'App\Http\Controllers\Backend\CategoryController@store')->name('category.store');
   Route::get('/edit/{id}', 'App\Http\Controllers\Backend\CategoryController@edit')->name('category.edit');
   Route::post('/update/{id}', 'App\Http\Controllers\Backend\CategoryController@update')->name('category.update');
   Route::get('/delete/{id}', 'App\Http\Controllers\Backend\CategoryController@destroy')->name('category.destroy');
});

// product route.....................................................
Route::group(['prefix' => 'product'], function () {
   Route::get('/manage', 'App\Http\Controllers\Backend\ProductController@index')->name('product.manage');
   Route::get('/create', 'App\Http\Controllers\Backend\ProductController@create')->name('product.create');
   Route::post('/store', 'App\Http\Controllers\Backend\ProductController@store')->name('product.store');
   Route::get('/edit/{id}', 'App\Http\Controllers\Backend\ProductController@edit')->name('product.edit');
   Route::post('/update/{id}', 'App\Http\Controllers\Backend\ProductController@update')->name('product.update');
   Route::get('/delete/{id}', 'App\Http\Controllers\Backend\ProductController@destroy')->name('product.destroy');
});

});