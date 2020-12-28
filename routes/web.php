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

/* administrator for control panel data */
Route::group(['prefix' => 'control-panel', 'middleware' => ['auth', 'role:administrator']], function () {
    Route::get('home', 'Administrator\HomeController@index')->name('administrator.dashboard');
    Route::resource('participant', 'Administrator\ParticipantController')->names('participant');
    Route::resource('selection', 'Administrator\SelectionGroupController')->names('selection');
    Route::resource('test', 'Administrator\TestGroupController')->names('test');
    Route::resource('questions', 'Administrator\QuestionAndAnswerController')->names('question_and_answer');
    Route::resource('exams', 'Administrator\ExamController')->names('exams');
    Route::post('exams/{id}/create_question', 'Administrator\ExamController@create_question')->name('exams.create_question');

});
/* end administrator for control panel data */

/* administrator for control panel data */
Route::group(['prefix' => 'participant', 'middleware' => ['auth', 'role:participant']], function () {
    Route::get('home', 'Participant\HomeController@index')->name('participant.dashboard');
});
/* participant for member */

Route::get('ok', function () {
    return Auth::user()->role;
});
