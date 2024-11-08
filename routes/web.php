<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;


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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('products', 'ProductsController');
    Route::resource('lendings', 'LendingController');
    Route::resource('reviews', 'ReviewController');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::put('/users/{user}/block', 'AdminController@toggleBlock')->name('users.toggle-block');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');

Route::post('/lendings/{product}', [LendingController::class, 'store'])->name('lendings.store');
Route::get('lendings/{lending}', [LendingController::class, 'show'])->name('lendings.show');
Route::put('/lendings/{id}/return', [LendingController::class, 'returnProduct'])->name('lendings.return');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::put('/users/{user}/block', [AdminController::class, 'toggleBlock'])->name('users.toggle-block');
Route::delete('/products/{product}/delete', [AdminController::class, 'deleteProduct'])->name('products.delete');






