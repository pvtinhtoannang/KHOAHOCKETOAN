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
    Route::get('/posts', ['as' => 'GET_POSTS_ROUTE', 'uses' => 'PostController@index']);

    //create new post
    Route::get('/post/create', ['as' => 'GET_CREATE_POST_ROUTE', 'uses' => 'PostController@getPostEditor']);
    Route::post('/post/create', ['as' => 'POST_CREATE_POST_ROUTE', 'uses' => 'PostController@createPost']);

    Route::get('/post-edit', ['as' => 'GET_POST_EDIT_ROUTE', 'uses' => 'PostController@getPostEdit']);

    //page
    Route::get('/pages', ['as' => 'GET_PAGES_ROUTE', 'uses' => 'PageController@index']);

    Route::get('/page/create', ['as' => 'GET_CREATE_PAGE_ROUTE', 'uses' => 'PageController@getPageEditor']);
    Route::post('/page/create', ['as' => 'POST_CREATE_PAGE_ROUTE', 'uses' => 'PageController@createPage']);

    //upload
    Route::get('/upload', ['as' => 'GET_UPLOAD_ROUTE', 'uses' => 'UploadController@getUpload']);
    Route::get('/upload/new', ['as' => 'GET_UPLOAD_NEW_ROUTE', 'uses' => 'UploadController@getUploadNew']);
    Route::post('/upload/new', ['as' => 'POST_UPLOAD_NEW_ROUTE', 'uses' => 'UploadController@postUploadNew']);

    //category
    Route::get('/category', ['as' => 'GET_CATEGORY_ROUTE', 'uses' => 'CategoryController@getCategory']);
    Route::post('/category', ['as' => 'POST_CATEGORY_ROUTE', 'uses' => 'CategoryController@addCategory']);

    //tag
    Route::get('/post_tag', ['as' => 'GET_TAG_ROUTE', 'uses' => 'TagController@getTag']);
    Route::post('/post_tag', ['as' => 'POST_TAG_ROUTE', 'uses' => 'TagController@addTag']);

    //ajax
    Route::get('/slug-generator/{slug}', 'AdminAjaxController@slugGenerator');
    Route::get('/post-name-generator/{post_name}', 'AdminAjaxController@postNameGenerator');
    Route::get('/get-attached-file/{id}', 'AdminAjaxController@getAttachedFile');
});
