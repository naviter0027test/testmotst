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
    Route::get('logout', 'Member\MemberController@logout');

    Route::get('password', 'Member\MemberController@passwordPage');
    Route::post('password', 'Member\MemberController@passwordUpdate');

    Route::group(['prefix' => 'project'], function() {
        Route::get('example', 'Member\ProjectController@example');
        Route::get('index', 'Member\ProjectController@index');
        Route::get('create', 'Member\ProjectController@createPage');
        Route::post('create', 'Member\ProjectController@create');
        Route::get('remove/{id}', 'Member\ProjectController@remove');
        Route::get('edit/{id}', 'Member\ProjectController@edit');
        Route::post('edit/{id}', 'Member\ProjectController@update');

        Route::group(['prefix' => 'task'], function() {
            Route::get('index/{projectId}', 'Member\TaskController@index');
            Route::get('{projectId}/create', 'Member\TaskController@createPage');
            Route::post('{projectId}/create', 'Member\TaskController@create');
        });
    });
});
