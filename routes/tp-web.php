<?php

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('logout', ['as' => 'getLogout', 'uses' => 'Auth\LoginController@logout']);


Route::post('reset-password', 'Auth\ResetPasswordController@sendMail');
Route::put('reset-password/{token}', 'Auth\ResetPasswordController@reset');



Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function () {
    Route::get('my-profile', ['as' => 'GET_MY_PROFILE', 'uses' => 'UserController@getMyProfile']);
    Route::post('my-profile', ['as' => 'POST_MY_PROFILE', 'uses' => 'UserController@updateMyProfile']);
});
