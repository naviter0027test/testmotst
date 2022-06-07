<?php

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

Route::group(['prefix' => 'member', 'middleware' => ['check.member']], function() {

    Route::get('login', 'Member\MemberController@loginPage');
    Route::post('login', 'Member\MemberController@login');
    Route::get('home', 'Member\MemberController@home');
    Route::get('/', 'Member\MemberController@index');
});
