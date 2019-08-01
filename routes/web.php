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

Route::get('/', function () {
    return redirect()->route('blog.categories.index');
});

//Блог
$groupData = [
    'namespace' => 'Blog',
    'prefix' => 'blog',
    'middleware' => 'web',
];

Route::group($groupData, function () {
    //BlogCategory
    Route::resource('categories', 'CategoryController')->names('blog.categories');
    //BlogPost
    Route::resource('posts', 'PostController')->names('blog.posts');
    //Comment
    Route::post('/comments/post/{post}', 'CommentController@storeCommentPost')->name('blog.comments.storeCommentPost');

    Route::post('/comments/category/{category}', 'CommentController@storeCommentCategory')->name('blog.comments.storeCommentCategory');

    Route::get('/download/{post}', 'PostController@download')->name('blog.posts.download');
});



