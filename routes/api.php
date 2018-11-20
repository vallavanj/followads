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

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api'); */


Route::post('register','api\User_apiController@user_register');
Route::post('profile','api\User_apiController@profile');
Route::post('otp_verification','api\User_apiController@otp_verification');
Route::post('logout','api\User_apiController@logout');
Route::post('single','User_apiController@user_edit');
Route::post('advertisement_get','User_apiController@advertisement_get');
Route::post('business_get','User_apiController@business_get');
Route::get('lang_list','api\Language_master_apiController@master_lang');
Route::post('home','api\Mobilehome@mobile_home');

Route::post('offer_details','api\OfferControllerapi@offer_details');
Route::post('write_advertisement_review','api\Write_Offer_ReviewController@write_offer_review');
Route::post('change_lang','api\User_apiController@change_lang');

Route::post('liked_advertisements_list','api\Liked_offer_listController@liked_offers_list');
Route::post('like_advertisement','api\Liked_offer_listController@like_offer');
Route::post('follow_business','api\Follow_storeController@followstore');
Route::post('followed_business_list','api\Follow_storeController@followed_store_list');

Route::post('save_bank_details','api\Save_Bank_AccController@save_bank_details');
Route::post('bank_list','api\Save_Bank_AccController@bank_list');
Route::post('business_detail','api\business_detailController@business_detail');
Route::post('transfer_money','api\Transfer_moneyController@transfer_money');

Route::post('searchdata','api\Searchcontroller@searchname');
Route::post('SearchSuggestion','api\Searchcontroller@SearchSuggestion');
Route::Post('searchfilter','api\Searchcontroller@search_filter');

Route::post('promotion_section_data','api\Promotion@promotion_section_data');
Route::post('User_used_offer_code','api\OfferControllerapi@User_used_offer_code');

Route::post('User_used_offer_code_list','api\OfferControllerapi@User_used_offer_code_list');
Route::post('search_suggestion','api\Searchcontroller@search_suggestion');

Route::post('notification_list','api\Notificationcontroller@notification_list');

Route::post('nearby_business_list','api\NearbyController@nearby_business_list');
Route::post('staticpages','api\staticpages@static_data');


/** Reminder ads save   **/
Route::Post('user_saved_ads_reminder','api\OfferControllerapi@user_saved_ads_reminder');

Route::post('user_saved_reminder_list','api\OfferControllerapi@user_saved_reminder_list');
Route::post('bank_account_edit','api\Save_Bank_AccController@bank_account_edit');



