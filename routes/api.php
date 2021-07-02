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

Route::middleware('auth:api',)->get('/user', function (Request $request) {
    return $request->user();
});

 //UserController
 Route::post('register','API\UserController@userRegister');
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
    Route::get('get-users','API\UserController@getUsers');

 });
 Route::get('current-user','API\UserController@currentUser');
 //Category Routes
 Route::get('categories','API\CategorieController@categories')->middleware('localization');
 Route::post('add-category','API\CategorieController@addNewCategory')->middleware('auth:api','localization');
 Route::get('show-categoryProducts/{idCategory}','API\CategorieController@showCategoryProducts')->middleware('localization');
 Route::get('show-category/{idCategory}','API\CategorieController@showCategory')->middleware('localization');
 Route::post('update-category/{id}','API\CategorieController@updateCategory')->middleware('auth:api','localization');
 Route::delete('delete-category/{id}','API\CategorieController@destroyCategory')->middleware('auth:api','localization');

 //Food Routes
Route::get('foods','API\FoodController@foods')->middleware('localization');
Route::post('add-newFood','API\FoodController@addNewFood')->middleware('auth:api','localization');
Route::get('show-food/{id}','API\FoodController@showFood')->middleware('localization');
Route::post('update-food/{id}','API\FoodController@updateFood')->middleware('auth:api','localization');
Route::post('update-foodStatus/{id}','API\FoodController@updateStatusProduct')->middleware('auth:api','localization');
Route::delete('delete-food/{id}','API\FoodController@destroyFood')->middleware('auth:api','localization');
Route::get('search-food','API\FoodController@searchFood')->middleware('localization');

 //Offer Routes\
 Route::middleware('auth:api','localization')->group( function (){
    Route::get('promotions','API\PromotionController@displayPromotions');
    Route::post('add-newPromotion','API\PromotionController@storeNewPromotion');
    Route::get('show-promotion/{id}','API\PromotionController@showPromotion');
    Route::get('show-promotionProducts/{id}','API\PromotionController@showPromotionProducts');
    Route::put('update-promotion/{id}','API\PromotionController@updatePromotion');
    Route::delete('delete-promotion/{id}','API\PromotionController@destroyPromotion');
    Route::put('disable-promotion/{id}','API\PromotionController@disablePromotion');
 });

 //Cart Routes
 Route::middleware('localization')->group( function (){
    Route::get('cart','API\CartController@getMyCart');
    Route::post('add-ToCart/{id}','API\CartController@addToCart');
    Route::delete('delete-cart','API\CartController@clearCart');
    Route::post('remove-item/{id}','API\CartController@removeItemCart');
 });

 //order Routes
 Route::middleware('auth:api')->group( function (){

    Route::post('makeOrder','API\OrderController@makeOrder');
    // Route::get('allOrders','API\OrderController@allOrders');
    // Route::get('getOpenedOrders','API\OrderController@getOpenedOrders');
    // Route::get('getClosedOrders','API\OrderController@getClosedOrders');
    // Route::post('ConfirmMoneyRecieve/{orderId}','API\OrderController@ConfirmMoneyRecieve');
    // Route::post('ConfirmDelivery/{orderId}','API\OrderController@ConfirmDelivery');
    // Route::get('myOrders','API\OrderController@myOrders');
    // Route::post('updateOrderDate/{orderId}','API\OrderController@updateOrderDate');
    });




