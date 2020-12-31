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
    Route::resource('materials', 'Administrator\MaterialController')->names('materials');
    Route::post('exams/{id}/create_question', 'Administrator\ExamController@create_question')->name('exams.create_question');
    Route::get('problem_solving/{id}/create', 'Administrator\ProblemSolvingController@create')->name('problem.create');
    Route::post('problem_solving', 'Administrator\ProblemSolvingController@store')->name('problem.store');
});
/* end administrator for control panel data */

/* participant for control panel data */
Route::group(['prefix' => 'participant', 'middleware' => ['auth', 'role:participant']], function () {
    Route::get('home', 'Participant\HomeController@index')->name('participant.home');
    Route::get('materi', 'Participant\HomeController@materi')->name('participant.materi');
    Route::get('quiz', 'Participant\HomeController@exam')->name('participant.exam');
    Route::get('/app/{any}', 'Participant\ExamController@index')
        ->where('any',    '.*');
});
/* participant for member */

