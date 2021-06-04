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

Route::get('/', function () {
    return redirect('login');
});

// login route
Route::get('/login', function () {
    return view('Auth.index');
})->middleware('guest')->name('login');
// sign in route
Route::post('/sign-in','AuthController@sigIn')->name('sign-in');
// register route
Route::post('/register','AuthController@register')->name('register');
// logout route
Route::put('/logout', 'AuthController@logout')->middleware('auth')->name('logout');


// dashboard route
Route::prefix('dashboard')->middleware('auth')->group(function () {
    
    Route::get('/', function () {
        return view('Admin.index');
    })->name('dashboard');

    //products route
    Route::get('products', 'ProductController@index')->name('dashboard.products');
    Route::post('/products/store', 'ProductController@store');
    Route::get('/products/getProducts', 'ProductController@products');
    Route::post('/products/image/{product}', 'ProductController@imageSave');
    Route::put('/products/update/{product}', 'ProductController@update');
    Route::delete('/products/destroy/{product}', 'ProductController@destroy');
    // profile route
    Route::get('profile', function () {
        return view('Admin.users.userProfile', ['user' => Auth()->user()]);
    })->name('dashboard.profile');
});
