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

Route::get('posts', 'Blog\PostController@posts');
// Route::group(['namespace' => 'Blog', 'prefix' => 'blog'],function(){
//    Route::get('posts','PostController@posts');
// });

Route::post('posts/create', 'Blog\PostController@store');

Route::post('posts/update/{id}', 'Blog\PostController@update');

// Route::post('/upload', 'Blog\PostController@uploads');

Route::delete('posts/delete/{id}', 'Blog\PostController@destroy');

Route::get('/posts/show/{id}', 'Blog\PostController@show');

Route::post('post/file/upload', 'PostController@uploads')->name('upload');

Route::post('/search', 'AppController@search')->name('search');