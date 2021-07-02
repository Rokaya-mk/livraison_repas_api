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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/storage/app/public/images/categories/{filename}', function ($filename)
 {
     $file = \Illuminate\Support\Facades\Storage::get($filename);
     return response('/storage/app/public/images/categories'.$file, 200)->header('Content-Type', 'image/jpeg');
 });
