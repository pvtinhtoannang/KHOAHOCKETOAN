<?php

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('logout', ['as' => 'getLogout', 'uses' => 'Auth\LoginController@logout']);


Route::post('reset-password', 'Auth\ResetPasswordController@sendMail');
Route::put('reset-password/{token}', 'Auth\ResetPasswordController@reset');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('my-profile', ['as' => 'GET_MY_PROFILE', 'uses' => 'UserController@getMyProfile']);
    Route::post('my-profile', ['as' => 'POST_MY_PROFILE', 'uses' => 'UserController@updateMyProfile']);
    Route::get('options-general', ['as' => 'GET_OPTION_GENERAL', 'uses' => 'OptionController@getOptionGeneral']);
    Route::post('options-general', ['as' => 'POST_OPTION_GENERAL', 'uses' => 'OptionController@postUpdateOptionGeneral']);
    Route::post('add-options-general', ['as' => 'ADD_OPTION_GENERAL', 'uses' => 'OptionController@postAddOptionGeneral']);
    Route::get('permissions-settings', ['as' => 'GET_PERMISSION_SETTINGS', 'uses' => 'PermissionController@getPermission']);
    Route::post('add-permissions-settings', ['as' => 'ADD_PERMISSION_SETTINGS', 'uses' => 'PermissionController@addPermission']);

    Route::get('ajax-permission-by-id/{id}', ['as' => 'GET_PERMISSION_BY_ID', 'uses' =>'PermissionController@getPermissionByID']);
    Route::post('update-permissions-settings', ['as' => 'UPDATE_PERMISSION_SETTINGS', 'uses' => 'PermissionController@updatePermissionByID']);

//    Route::post('update-permission-for-role/{role-id}', ['as' => 'UPDATE_PERMISSION_FOR_ROLE', 'uses' => 'PermissionController@updatePermissionForRole'])->where('id', '[0-9]+');
    Route::post('update-permission-for-role', ['as' => 'UPDATE_PERMISSION_FOR_ROLE', 'uses' => 'PermissionController@updatePermissionForRole']);
    Route::get('ajax-permission-by-role/{role_id}', ['as' => 'GET_PERMISSION_BY_ROLE', 'uses' => 'PermissionController@getPermissionByRole'])->where('id', '[0-9]+');

});





