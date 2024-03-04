<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;


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


Route::get('/users', [UserController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users/store', [UserController::class, 'store']);


Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    Route::get('/', 'HomeController@index')->name('home.index');
    
    
    Route::group(['middleware' => ['web', 'auth', 'admin']], function () {
        // Category
        Route::get('/category', 'CategoryController@index')->name('home.category'); 
        Route::get('/category/create', 'CategoryController@create')->name('category.create');
        Route::post('/category/store', 'CategoryController@store')->name('category.store'); 
        Route::get('/category/{category}/edit', 'CategoryController@edit')->name('category.edit'); 
        Route::put('/category/{category}', 'CategoryController@update')->name('category.update'); 
        Route::delete('/category/{category}', 'CategoryController@destroy')->name('category.destroy'); 
    
        // Products
        Route::get('/products', 'ProductController@show')->name('products.show'); 
        Route::get('/products/create', 'ProductController@create')->name('products.create'); 
        Route::post('/products/store', 'ProductController@store')->name('products.store'); 
        Route::get('/products/{product}/edit', 'ProductController@edit')->name('products.edit'); 
        Route::put('/products/{product}', 'ProductController@update')->name('products.update'); 
        Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy'); 
    
        // Users
        Route::get('/users', 'UserController@show')->name('users.show'); 
        Route::get('/users/add', 'UserController@add')->name('users.add'); 
        Route::post('/users/storedata', 'UserController@storedata')->name('users.storedata');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit'); 
        Route::put('/users/{user}', 'UserController@update')->name('users.update');
        Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy'); 

        // Orders
        Route::get('/status', 'OrdersController@status')->name('users.show'); 

    });



    Route::group(['middleware' => ['guest']], function() {
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
         // Orders
         Route::get('/orders/add/{productId}', 'OrdersController@add')->name('orders.add');
         Route::post('/orders/store', 'OrdersController@store')->name('orders.store');
         Route::get('/orders/history', 'OrdersController@history')->name('orders.history');  

         Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});