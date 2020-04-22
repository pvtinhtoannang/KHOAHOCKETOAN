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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'GET_ADMIN_DASHBOARD_ROUTE', 'uses' => 'AdminController@getAdminDashboard']);
    //post
    Route::get('/post-new', ['as' => 'GET_POST_NEW_ROUTE', 'uses' => 'PostController@getPostNew']);
    Route::post('/post-new', ['as' => 'POST_POST_NEW_ROUTE', 'uses' => 'PostController@postPostNew']);

    Route::get('/post-edit', ['as' => 'GET_POST_EDIT_ROUTE', 'uses' => 'PostController@getPostEdit']);
    Route::get('/post', ['as' => 'GET_POST_ALL_ROUTE', 'uses' => 'PostController@getPostAll']);

    //page
    Route::get('/page-new', ['as' => 'GET_PAGE_NEW_ROUTE', 'uses' => 'PageController@getPageNew']);
    Route::post('/page-new', ['as' => 'POST_PAGE_NEW_ROUTE', 'uses' => 'PageController@postPageNew']);

    Route::get('/page', ['as' => 'GET_PAGE_ALL_ROUTE', 'uses' => 'PageController@getPageAll']);

    //upload
    Route::get('/upload', ['as' => 'GET_UPLOAD_ROUTE', 'uses' => 'UploadController@getUpload']);
    Route::get('/upload-new', ['as' => 'GET_UPLOAD_NEW_ROUTE', 'uses' => 'UploadController@getUploadNew']);
    Route::post('/upload-new', ['as' => 'POST_UPLOAD_NEW_ROUTE', 'uses' => 'UploadController@postUploadNew']);

    //category
    Route::get('/category', ['as' => 'GET_CATEGORY_ROUTE', 'uses' => 'CategoryController@getCategory']);
    Route::post('/category', ['as' => 'POST_CATEGORY_ROUTE', 'uses' => 'CategoryController@postAddNewCategory']);

    //tag
    Route::get('/post_tag', ['as' => 'GET_TAG_ROUTE', 'uses' => 'TagController@getTag']);
    Route::post('/post_tag', ['as' => 'POST_TAG_ROUTE', 'uses' => 'TagController@postAddNewTag']);

    //ajax
    Route::get('/check-slug/{slug}', 'AdminAjaxController@checkSlug');
    Route::get('/check-post-name/{post_name}', 'AdminAjaxController@checkPostName');
    Route::get('/get-attached-file/{id}', 'AdminAjaxController@getAttachedFile');
});
