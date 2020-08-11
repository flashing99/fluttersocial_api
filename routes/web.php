<?php

use App\Mail\NewUserRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('test-email', function (){
    $user = \App\User::find(19); // first we get the user id
    Mail::to($user)->queue(new NewUserRegistered($user)); // then by Mail system send email in queue to user
});
