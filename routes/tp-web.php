<?php

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('logout', ['as' => 'getLogout', 'uses' => 'Auth\LoginController@logout']);
