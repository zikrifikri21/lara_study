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

// use Illuminate\Routing\Route;

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function () {
    Route::get('dashboard', 'HomeController@index');
    // Route::get('category', 'CategoryController@index');
    // Route::post('category', 'CategoryController@store')->name('admin.category');
    Route::resource('category', 'CategoryController');

});