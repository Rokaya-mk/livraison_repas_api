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
 Route::post('user_register','API\UserController@userRegister')->middleware('localization');
 Route::post('verification_email','API\UserController@emailVerification')->middleware('localization');
 Route::post('login','API\UserController@login')->middleware('localization');
 Route::post('forgot-password','API\UserController@forgotPassword')->middleware('localization');
 Route::post('reset-password','API\UserController@resetPassword')->middleware('localization');
 Route::post('resend-reset','API\UserController@resendCodeReset')->middleware('localization');

 Route::middleware('auth:api','localization')->group( function (){
    Route::post('ajouter-livreur','API\UserController@ajouterLivreur')->middleware('can:isAdmin');
    Route::put('change-password','API\UserController@changePassword');
    Route::post('logout-api','API\UserController@logoutApi');
    Route::post('update-profile','API\UserController@updateProfile');
    Route::get('profile','API\UserController@showMyProfile');
    Route::get('delivery-guys','API\UserController@allDeliveryGuys')->middleware('can:isAdmin');
 });

 //Category Routes
 Route::get('categories','API\CategoryController@categories');
 Route::post('add-category','API\CategoryController@addNewCategory')->middleware('auth:api');
 Route::get('show-categoryProducts/{idCategory}','API\CategoryController@showCategoryProducts');
 Route::post('update-category/{id}','API\CategoryController@updateCategory')->middleware('auth:api');
 Route::delete('delete-category/{id}','API\CategoryController@destroyCategory')->middleware('auth:api');

 //Food Routes
 Route::get('foods','API\FoodController@foods');
 Route::post('add-newFood','API\FoodController@addNewFood')->middleware('auth:api');
 Route::get('show-food/{id}','API\FoodController@showFood');
 Route::put('update-food/{id}','API\FoodController@updateFood')->middleware('auth:api');
 Route::put('update-foodStatus/{id}','API\FoodController@updateStatusProduct')->middleware('auth:api');
 Route::delete('delete-food/{id}','API\FoodController@destroyFood')->middleware('auth:api');
 Route::get('search-food','API\FoodController@searchFood');

 //Offer Routes\
 Route::middleware('auth:api')->group( function (){
    Route::get('offers','API\OfferController@displayOffers');
    Route::post('add-newOffer','API\OfferController@storeNewOffer');
    Route::get('show-offer/{id}','API\OfferController@showOffer');
    Route::put('update-offer/{id}','API\OfferController@updateOffer');
    Route::delete('delete-offer/{id}','API\OfferController@destroyOffer');
    Route::put('disable-offer/{id}','API\OfferController@disableOffer');
 });

