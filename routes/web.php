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

Route::get('/', function () {
    return view('welcome');
})->name('home');;

//Auth::routes();
//Route::get('admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
//Route::post('admin/login',[App\Http\Controllers\Auth\LoginController::class, 'login']);
//Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin',], function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::get('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'adminLogout'])->name('adminLogout');
   
    
    
   Route::group(['middleware' => 'adminauth'], function () {
    Route::resource('/product', 'App\Http\Controllers\Admin\ProductController'); 
    Route::get('/category', [App\Http\Controllers\Admin\ProductController::class, 'category'])->name('category');
    Route::post('/images/upload', [App\Http\Controllers\Admin\ProductController::class, 'image'])->name('image');
 Route::get('/', function () {
           return view('home');
       })->name('adminDashboard');
    });
    
});

Route::get('/test', function () {
    return view('home');
});