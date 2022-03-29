<?php

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


//Route::post('admin/{admin}/logout', 'App\Http\Controllers\API\RegisterController@logout');
Route::post('user/status/{id}/{status}', 'App\Http\Controllers\AdminManagerController@user_status');

//RegisterController routes
Route::post('register/create_user', 'App\Http\Controllers\API\RegisterController@register');
Route::post('register/promo_code_register', 'App\Http\Controllers\API\RegisterController@promo_code_register');
Route::post('register/confirm_otp', 'App\Http\Controllers\API\RegisterController@confirm_otp');
Route::post('register/login', 'App\Http\Controllers\API\RegisterController@login');

//AccountManagerController routes
Route::post('user/update_user_record', 'App\Http\Controllers\AccountManagerController@update_user_record');
Route::post('user/update_profile_img', 'App\Http\Controllers\AccountManagerController@update_profile_img');
Route::post('user/create_personal_data', 'App\Http\Controllers\AccountManagerController@create_personal_data');
Route::get('user/view_user_profile/{id}', 'App\Http\Controllers\AccountManagerController@view_user_profile');
Route::get('user/profile_post/{id}/{pid}', 'App\Http\Controllers\AccountManagerController@view_single_post');
Route::get('user/referrer_network_downline/{id}', 'App\Http\Controllers\AccountManagerController@referrer_network_downline');
Route::get('user/referrer_network_downline_transaction/{id}', 'App\Http\Controllers\AccountManagerController@referrer_network_downline_transaction');
Route::post('user/make_post', 'App\Http\Controllers\AccountManagerController@make_post');
Route::post('user/monetized_post_coin_payment', 'App\Http\Controllers\AccountManagerController@monetized_post_coin_payment');
Route::post('user/create_date_request', 'App\Http\Controllers\AccountManagerController@create_date_request');
Route::post('user/date_request_application', 'App\Http\Controllers\AccountManagerController@date_request_application');
Route::post('user/date_application_response', 'App\Http\Controllers\AccountManagerController@date_application_response');
Route::get('user/show_all_open_date_request', 'App\Http\Controllers\AccountManagerController@show_all_open_date_request');
Route::get('user/show_my_date_applicant/{user_id}', 'App\Http\Controllers\AccountManagerController@show_my_date_applicant');

Route::post('user/send_message', 'App\Http\Controllers\MessagesController@send_message');
Route::post('user/message/make_payment', 'App\Http\Controllers\MessagesController@make_payment');
Route::get('user/show_messages/{sender}/{recipient}', 'App\Http\Controllers\MessagesController@show_messages');
Route::post('user/message/make_payment_offer_request', 'App\Http\Controllers\MessagesController@make_payment_offer_request');
Route::post('user/message/offer_response', 'App\Http\Controllers\MessagesController@offer_response');
Route::post('user/message/sender_confirm_offer', 'App\Http\Controllers\MessagesController@sender_confirm_offer');
Route::post('user/message/recipient_apporve_offer_payment_service', 'App\Http\Controllers\MessagesController@recipient_apporve_offer_payment_service');
Route::get('user/my_payment_offer_list/{sender}', 'App\Http\Controllers\MessagesController@my_payment_offer_list');
Route::post('user/message/send_support_ticket', 'App\Http\Controllers\MessagesController@send_support_ticket');
Route::post('user/message/reply_support_ticket', 'App\Http\Controllers\MessagesController@reply_support_ticket');
Route::post('user/message/close_support_ticket', 'App\Http\Controllers\MessagesController@close_support_ticket');


//AdminManagerController routes
Route::post('admin/create_wallet_settings', 'App\Http\Controllers\AdminManagerController@create_wallet_settings');
Route::get('admin/show_admin_wallet_settings', 'App\Http\Controllers\AdminManagerController@show_admin_wallet_settings');
Route::post('admin/create_subscription_module', 'App\Http\Controllers\AdminManagerController@create_subscription_module');
Route::post('admin/add_admin_privilege', 'App\Http\Controllers\AdminManagerController@add_admin_privilege');
Route::post('admin/remove_admin_privilege', 'App\Http\Controllers\AdminManagerController@remove_admin_privilege');

Route::get('admin/show_all_subscription_modules', 'App\Http\Controllers\AdminManagerController@show_all_subscription_modules');
Route::get('admin/show_subscription_by_module/{module}', 'App\Http\Controllers\AdminManagerController@show_subscription_by_module');
Route::post('admin/delete_sub_module', 'App\Http\Controllers\AdminManagerController@delete_sub_module');
Route::get('admin/show_all_users_subscriptions', 'App\Http\Controllers\AdminManagerController@show_all_users_subscriptions');

Route::post('admin/create_bonus_voucher', 'App\Http\Controllers\AdminManagerController@create_bonus_voucher');
Route::post('admin/delete_voucher', 'App\Http\Controllers\AdminManagerController@delete_voucher');
Route::get('admin/show_all_voucher', 'App\Http\Controllers\AdminManagerController@show_all_voucher');

Route::post('user/user_search', 'App\Http\Controllers\AjaxRequestController@user_search');
Route::post('user/verify_voucher', 'App\Http\Controllers\AccountManagerController@verify_voucher');
Route::post('user/make_subscription', 'App\Http\Controllers\AccountManagerController@make_subscription');
Route::post('user/stealth_mode_subscription', 'App\Http\Controllers\AccountManagerController@stealth_mode_subscription');
Route::get('user/show_my_subscription/{id}', 'App\Http\Controllers\AccountManagerController@show_my_subscription');



Route::post('users/load_index_page_escorts_data', 'App\Http\Controllers\AjaxRequestController@load_index_page_escorts');
Route::post('users/load_index_subscribers', 'App\Http\Controllers\AjaxRequestController@load_index_subescorts');

Route::post('users/load_male_escorts_data', 'App\Http\Controllers\AjaxRequestController@load_male_escorts_page');
Route::post('users/load_female_escorts_data', 'App\Http\Controllers\AjaxRequestController@load_female_escorts_page');
Route::post('users/load_escorts_on_travel_data', 'App\Http\Controllers\AjaxRequestController@load_escorts_on_travel_page');
Route::post('users/load_verified_escorts_data', 'App\Http\Controllers\AjaxRequestController@load_verified_escorts_page');



Route::post('users/recover_password', 'App\Http\Controllers\API\RegisterController@recover_password');

Route::post('buyer/login', 'App\Http\Controllers\API\BuyerAuthController@login');
Route::post('buyer/{buyer}/logout', 'App\Http\Controllers\API\BuyerAuthController@logout');
Route::get('buyers', 'App\Http\Controllers\API\BuyerAuthController@index');
Route::get('buyer/{buyer}', 'App\Http\Controllers\API\BuyerAuthController@show');
Route::put('buyer/{buyer}', 'App\Http\Controllers\API\BuyerAuthController@update');
Route::post('buyer/{buyer}/activate', 'App\Http\Controllers\API\BuyerAuthController@activate');
Route::post('buyer/{buyer}/deactivate', 'App\Http\Controllers\API\BuyerAuthController@deactivate');
Route::post('buyer/register', 'App\Http\Controllers\API\BuyerAuthController@register');

   
Route::middleware('auth:api')->group( function () {
    // Route::resource('product', 'API\ProductController');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::apiResource('product','App\Http\Controllers\ProductController');

/**********************************************************
Route::prefix('product')->group(function(){
    Route::apiResource('/{product}/reviews','App\Http\Controllers\ReviewsController');
});
**********************************************************/

//product category and sub category
//Route::post('store/c', 'App\Http\Controllers\ProductCategoriesController@new_product_category');
//Route::post('store/sc', 'App\Http\Controllers\ProductCategoriesController@new_product_sub_category');
//Route::get('store/c/', 'App\Http\Controllers\ProductCategoriesController@category');
//Route::get('store/c/{id}', 'App\Http\Controllers\ProductCategoriesController@Single_category');
