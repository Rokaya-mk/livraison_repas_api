<?php
use App\Http\Controllers\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 //UserController
 Route::post('user_register','API\UserController@userRegister');
 Route::post('verification_email','API\UserController@emailVerification');
 Route::post('login','API\UserController@login');
 Route::post('forgot-password','API\UserController@forgotPassword');
 Route::post('reset-password','API\UserController@resetPassword');

 Route::middleware('auth:api')->group( function (){
    Route::post('ajouter-livreur','API\UserController@ajouterLivreur')->middleware('can:isAdmin');
    Route::put('change-password','API\UserController@changePassword');
    Route::post('logout-api','API\UserController@logoutApi');

 });




