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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'PassportController@register');
Route::post('login', 'PassportController@login');
 
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');
    Route::post('/seller/register', 'SellerController@store');
    Route::get('/seller/{id}','SellerController@getseller');
    Route::get('/showseller','SellerController@show');
    Route::post('/skill', 'SkillController@store');
    Route::get('/skills','SkillController@show');
    Route::get('/skill/{id}','SkillController@getskill');
});