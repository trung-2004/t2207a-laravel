<?php

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

Route::get('/', [\App\Http\Controllers\WebController::class, "home"]);

Route::get("/shop", [\App\Http\Controllers\WebController::class, "shop"]);

Route::get("/search", [\App\Http\Controllers\WebController::class, "search"]);

Route::get("/blog", [\App\Http\Controllers\WebController::class, "blog"]);

Route::get("/cart", [\App\Http\Controllers\WebController::class, "cart"]);

Route::get("/add-to-cart/{product}", [\App\Http\Controllers\WebController::class, "addToCart"]);

Route::get("/category/{category:slug}", [\App\Http\Controllers\WebController::class, "category"]);// category:slug (truyền vào slug của category)

Route::get("/product/{product:slug}", [\App\Http\Controllers\WebController::class, "product_detail"]);

Route::get("/check-out", [\App\Http\Controllers\WebController::class, "checkOut"]);

Route::post("/check-out", [\App\Http\Controllers\WebController::class, "placeOrder"]);

Route::get("/thank-you/{order}", [\App\Http\Controllers\WebController::class, "thankYou"]);

Route::get("/add-to-favourite/{product}", [\App\Http\Controllers\WebController::class, "addToFavourite"]);

Route::get("/favourite", [\App\Http\Controllers\WebController::class, "favourite"]);

// 2 cái này dùng cho paypal
Route::get('/success-transaction/{order}', [\App\Http\Controllers\WebController::class, 'successTransaction'])->name('successTransaction');

Route::get('/cancel-transaction/{order}', [\App\Http\Controllers\WebController::class, 'cancelTransaction'])->name('cancelTransaction');
//
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin
Route::get("/admin", [\App\Http\Controllers\AdminController::class, "admin"])->middleware(["auth"]);// middleware: phải đăng nhập thì ms vào đc

Route::get("/admin/orders", [\App\Http\Controllers\AdminController::class, "orders"])->middleware(["auth"]);

Route::get("/admin/invoice/{order}", [\App\Http\Controllers\AdminController::class, "invoice"])->middleware(["auth"]);
