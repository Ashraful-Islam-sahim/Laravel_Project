<?php

use App\Http\Controllers\ProfileController;
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


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// my dahsboard route

Route::group(['prefix' =>  'admin'], function(){
   Route::get('/dashboard', 'App\Http\Controllers\Backend\pagescontroller@index')->middleware(['auth', 'verified'])->name('dashboard');
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

// division route...................................................
Route::group(['prefix' => 'division'], function () {
   Route::get('/manage', 'App\Http\Controllers\Backend\DivisionController@index')->name('division.manage');
   Route::get('/create', 'App\Http\Controllers\Backend\DivisionController@create')->name('division.create');
   Route::post('/store', 'App\Http\Controllers\Backend\DivisionController@store')->name('division.store');
   Route::get('/edit/{id}', 'App\Http\Controllers\Backend\DivisionController@edit')->name('division.edit');
   Route::post('/update/{id}', 'App\Http\Controllers\Backend\DivisionController@update')->name('division.update');
   Route::get('/delete/{id}', 'App\Http\Controllers\Backend\DivisionController@destroy')->name('division.destroy');
});

// district route.....................................................
Route::group(['prefix' => 'district'], function () {
   Route::get('/manage', 'App\Http\Controllers\Backend\DistrictController@index')->name('district.manage');
   Route::get('/create', 'App\Http\Controllers\Backend\DistrictController@create')->name('district.create');
   Route::post('/store', 'App\Http\Controllers\Backend\DistrictController@store')->name('district.store');
   Route::get('/edit/{id}', 'App\Http\Controllers\Backend\DistrictController@edit')->name('district.edit');
   Route::post('/update/{id}', 'App\Http\Controllers\Backend\DistrictController@update')->name('district.update');
   Route::get('/delete/{id}', 'App\Http\Controllers\Backend\DistrictController@destroy')->name('district.destroy');
});
// Slider route.....................................................
Route::group(['prefix' => 'slider'], function () {
   Route::get('/manage', 'App\Http\Controllers\Backend\SliderController@index')->name('slider.manage');
   Route::get('/create', 'App\Http\Controllers\Backend\SliderController@create')->name('slider.create');
   Route::post('/store', 'App\Http\Controllers\Backend\SliderController@store')->name('slider.store');
   Route::get('/edit/{id}', 'App\Http\Controllers\Backend\SliderController@edit')->name('slider.edit');
   Route::post('/update/{id}', 'App\Http\Controllers\Backend\SliderController@update')->name('slider.update');
   Route::get('/delete/{id}', 'App\Http\Controllers\Backend\SliderController@destroy')->name('slider.destroy');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


});