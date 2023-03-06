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
    return redirect('/member/login');
});

Route::get('/content/aapipaa', 'Member\ContentController@aapipaa');
Route::get('/content/websocket/learn', 'Member\ContentController@webSocketLearn');
Route::get('/content/websocket/two', 'Member\ContentController@webSocketLearn2');

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
            Route::get('all/gantt/json', 'Member\TaskController@ganttAllJson');
            Route::get('{projectId}/create', 'Member\TaskController@createPage');
            Route::post('{projectId}/create', 'Member\TaskController@create');
            Route::get('{projectId}/edit/{taskId}', 'Member\TaskController@edit');
            Route::post('{projectId}/edit/{taskId}', 'Member\TaskController@update');
            Route::get('{projectId}/remove/{taskId}', 'Member\TaskController@remove');
            Route::get('{projectId}/gantt', 'Member\TaskController@gantt');
            Route::get('{projectId}/gantt/json', 'Member\TaskController@ganttJson');
        });
    });

    Route::group(['prefix' => 'content'], function() {
        Route::get('index', 'Member\ContentController@index');
        Route::get('create', 'Member\ContentController@createPage');
        Route::post('create', 'Member\ContentController@create');
        Route::get('remove/{id}', 'Member\ContentController@remove');
        Route::get('edit/{id}', 'Member\ContentController@edit');
        Route::post('edit/{id}', 'Member\ContentController@update');
    });
});
