<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');
Route::resource('posts','Api\\PostController');  // this is contain all PostController method in one line
Route::resource('comments','Api\\CommentController');

Route::post('posts/{post}/comment', 'Api\\PostController@comment'); // to create a new comment
