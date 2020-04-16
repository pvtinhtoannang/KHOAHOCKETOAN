<?php
require_once 'tp-web.php';
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

Route::get('/', function () {
    return 0;
});

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'GET_ADMIN_DASHBOARD_ROUTE', 'uses' => 'AdminController@getAdminDashboard']);
    //post
    Route::get('/post-new', ['as' => 'GET_POST_NEW_ROUTE', 'uses' => 'PostController@getPostNew']);
    Route::get('/post', ['as' => 'GET_POST_ALL_ROUTE', 'uses' => 'PostController@getPostALL']);

    //category
    Route::get('/category', ['as' => 'GET_CATEGORY_ROUTE', 'uses' => 'CategoryController@getCategory']);
    Route::post('/category', ['as' => 'POST_CATEGORY_ROUTE', 'uses' => 'CategoryController@postAddNewCategory']);

    //ajax
    Route::get('/check-slug/{slug}', 'AdminAjaxController@checkSlug');

});
