<?php

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
use App\theloai;
Route::resource('message', 'MessageController');
//for who is online
Route::get('online','OnlineController@index');
Route::post('pusher/auth','OnlineController@endpoint');
//for activti stream
Route::get('activities','ActivityController@getIndex');
Route::post('activities/like','ActivityController@postLike');
//for notification
Route::get('noti','NotificationController@getIndex');
Route::post('noti','NotificationController@postNotify');
//for chat box
Route::get('chat', 'ChatController@getIndex');
Route::post('message','ChatController@postMessage');
//for facebook
Route::get('facebook/redirect','Auth\SocialController@redirectToProvider');
Route::get('facebook/callback','Auth\SocialController@handleProviderCallback');
//for Google
Route::get('google/redirect','Auth\SocialController@redirectToProviderGoogle');
Route::get('google/callback','Auth\SocialController@handleProviderCallbackGoogle');

//page

Route::get('dangnhap','PageController@get_dangnhap');
Route::post('dangnhap','PageController@post_dangnhap');
Route::get('dangxuat','PageController@dangxuat');

Route::get('taikhoan','PageController@get_taikhoan');
Route::post('taikhoan','PageController@post_taikhoan');

Route::get('dangky','PageController@get_dangky');
Route::post('dangky','PageController@post_dangky');

Auth::routes();
