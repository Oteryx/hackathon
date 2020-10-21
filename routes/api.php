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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

    Route::post('login', 'LoginController@login')->name('login');

    Route::get('spots', 'SpotController@index')->name('getSpots');
    Route::get('users', 'UserController@index')->name('getUsers');
    Route::get('projects', 'ProjectController@index')->name('getProjects');

    Route::post('spots', 'SpotController@store')->name('addSpot');
    Route::post('users', 'UserController@store')->name('addUser');
    Route::post('projects', 'ProjectController@store')->name('addProject');

    Route::delete('users/{id}', 'UserController@destroy')->name('deleteUser');
    Route::put('users/{id}', 'UserController@update')->name('editUserConfirm');
    Route::patch('users/{id}', 'UserController@updatePassword')->name('changePassword');

    Route::delete('spots/{id}', 'SpotController@destroy')->name('deleteSpot');
    Route::put('spots/{id}', 'SpotController@update')->name('editSpotConfirm');

    Route::delete('projects/{id}', 'ProjectController@destroy')->name('deleteProject');
    Route::put('projects/{id}', 'ProjectController@update')->name('editProjectConfirm');

    Route::post('register', 'RegisterController@register')->name('register');


    Route::post('register', 'RegisterController@register')->name('register');

    Route::group(['middleware' => ['auth:api','judge']], function () {

        Route::get('email/verify/{hash}', 'VerificationController@verify')->name('verification.verify');

        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

        Route::get('user', 'AuthenticationController@user')->name('user');

        Route::post('logout', 'LoginController@logout')->name('logout');

    });

});
