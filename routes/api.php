<?php

use Illuminate\Http\Request;

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


Route::middleware('Localization')->group(function () {
//User Control Auth
Route::post('login', 'AuthController@login');
Route::post('signup', 'AuthController@new_signup');
Route::post('anonymous', 'AnonymousUserController@register');
Route::apiResource('Promo', 'PromoCodesController');
Route::post('reset-password', 'AuthController@reset');
Route::post('resend-verify', 'AuthController@resend');
Route::get('near-by', 'BranchesController@nearBy');
Route::get('fees', 'BranchesController@fees');
Route::get('delivery', 'BranchesController@delivery');
//Resource For Unknown User
Route::apiResource('Cities', 'CitiesController');
Route::apiResource('Offers', 'OffersController');
Route::apiResource('Offerdetails', 'OffersController');
Route::apiResource('Areas', 'AreaController');
Route::apiResource('Branches', 'BranchesController');
Route::apiResource('Menus', 'MenuController');
Route::apiResource('Languages', 'LanguagesApiController');
Route::apiResource('Countries', 'CountryController');
Route::apiResource('Menu', 'MenuController');
Route::apiResource('Mealdetails', 'MealTypeController');
Route::get('MealsType/{id}', 'MealTypeController@paginate');
Route::get('BranchArea/{id}', 'BranchesController@brancheById');
Route::apiResource('languages', 'LanguageController', ['only' => ['index']]);
Route::middleware('auth:api')->group(function () {
Route::post('confirmation', 'AuthController@confirm');
Route::middleware('Verify')->group(function () {
//Protected Login To Authntcate
Route::get('logout', 'AuthController@logout');
Route::post('Make-Order', 'OrdersController@index');
Route::post('Make-Redeem', 'PointsController@index');
Route::get('Orders', 'OrdersController@orders');
Route::apiResource('Rates', 'RateController');
Route::get('Last-Order', 'OrdersController@progress');
Route::post('profile', 'AuthController@user');
Route::get('MealPoint', 'PointsController@MealsPoint');
Route::apiResource('address', 'AddressController');
Route::post('update_addr/{id}', 'AddressController@update_addr');
Route::post('notify', 'HomeController@notify');
Route::post('notifications', 'AuthController@notification');
Route::get('view-profile', 'AuthController@getName');
});
});
});


