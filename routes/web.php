<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>'CheckSes'], function ()
{
    Route::get('/', 'DashboardController@dashboard')->name('index');
    Route::resource('/category', 'CategoryController');
    Route::resource('/comment', 'CommentController',['only' => [ 'store']]);
    Route::resource('/posts', 'PostController');

});
