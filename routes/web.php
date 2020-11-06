<?php

use App\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['prefix' => 'control-panel', 'middleware' => ['auth', 'role:administrator']], function () {
    Route::get('home', 'Administrator\HomeController@index')->name('administrator.dashboard');

});


Route::group(['prefix' => 'participant'], function () {
    Route::get('home', 'Participant\HomeController@index')->name('participant.dashboard');
});

