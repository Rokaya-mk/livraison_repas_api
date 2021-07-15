<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::get('/storage/app/public/images/categories/{filename}', function ($filename)
 {
     $file = \Illuminate\Support\Facades\Storage::get($filename);
     return response('/storage/app/public/images/categories'.$file, 200)->header('Content-Type', 'image/jpeg');
 });


Auth::routes();

Route::get('/home', [App\Http\Controllers\WEB\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\WEB\DashboardController::class, 'index'])->name('dashboard');

Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//food Routes
Route::get('/foods', [App\Http\Controllers\WEB\FoodController::class, 'foods'])->name('foods');
Route::get('/food/create', [App\Http\Controllers\WEB\FoodController::class, 'create'])->name('food.create');
Route::post('/food/store', [App\Http\Controllers\WEB\FoodController::class, 'store'])->name('food.store');
Route::get('/food/show/{id}', [App\Http\Controllers\WEB\FoodController::class, 'show'])->name('food.show');
Route::get('/food/edit/{id}', [App\Http\Controllers\WEB\FoodController::class, 'edit'])->name('food.edit');
Route::put('/food/update/{id}', [App\Http\Controllers\WEB\FoodController::class, 'update'])->name('food.update');
Route::delete('/food/destroy/{id}', [App\Http\Controllers\WEB\FoodController::class, 'destroy'])->name('food.destroy');

//categories Routes
Route::get('/categories', [App\Http\Controllers\WEB\CategorieController::class, 'index'])->name('categories');
Route::get('/categorie/create', [App\Http\Controllers\WEB\CategorieController::class, 'create'])->name('categorie.create');
Route::post('/categorie/store', [App\Http\Controllers\WEB\CategorieController::class, 'store'])->name('categorie.store');
Route::get('/categorie/showFoodsCategorie/{id}', [App\Http\Controllers\WEB\CategorieController::class, 'showFoodsCategorie'])->name('categorie.foods.show');
Route::get('/categorie/edit/{id}', [App\Http\Controllers\WEB\CategorieController::class, 'edit'])->name('categorie.edit');
Route::put('/categorie/update/{id}', [App\Http\Controllers\WEB\CategorieController::class, 'update'])->name('categorie.update');
Route::delete('/categorie/destroy/{id}', [App\Http\Controllers\WEB\CategorieController::class, 'destroy'])->name('categorie.destroy');

//promotion Routes
Route::get('/promos', [App\Http\Controllers\WEB\PromoController::class, 'index'])->name('promos');
Route::get('/promo/create', [App\Http\Controllers\WEB\PromoController::class, 'create'])->name('promo.create');
Route::post('/promo/store', [App\Http\Controllers\WEB\PromoController::class, 'store'])->name('promo.store');
Route::get('/promo/show/{id}', [App\Http\Controllers\WEB\PromoController::class, 'show'])->name('promo.show');
Route::get('/promo/edit/{id}', [App\Http\Controllers\WEB\PromoController::class, 'edit'])->name('promo.edit');
Route::put('/promo/update/{id}', [App\Http\Controllers\WEB\PromoController::class, 'update'])->name('promo.update');
Route::delete('/promo/destroy/{id}', [App\Http\Controllers\WEB\PromoController::class, 'destroy'])->name('promo.destroy');
