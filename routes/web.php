<?php

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

Route::get('/form', function () {
    return view('assessment/form');
});

Route::group( ['middleware' => ['auth']], function() {
    Route::resource('users', 'UserListController');
    Route::resource('roles', 'RoleController');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user', 'UserListController@index')->name('user.index');

Route::get('questionnaire', 'QuestionnaireController@index')->name('questionnaire.index');
Route::get('/questionnaire/add', 'QuestionnaireController@create')->name('questionnaire.create');
Route::post('/questionnaire/add', 'QuestionnaireController@store')->name('questionnaire.store');
Route::get('/questionnaire/{questionnaire}/edit', 'QuestionnaireController@edit')->name('questionnaire.edit');
Route::get('/questionnaire/{questionnaire}', array('as' => 'questionnaire.update', 'uses' => 'QuestionnaireController@update'));
Route::delete('/questionnaire/{questionnaire}', 'QuestionnaireController@destroy')->name('questionnaire.destroy');

Route::get('/assessment/{user}/form', 'MakeQuestionnaireController@assessment')->name('assessment');
Route::post('/assessment/{user}', 'MakeQuestionnaireController@doassessment')->name('doassessment');

Route::get('/assessment/{Auth}/result', 'MakeQuestionnaireController@totalScore')->name('totalScore');

Route::get('/assessment/{user}/show_for_admin', 'MakeQuestionnaireController@resultTotlalScore')->name('resultTotlalScore');
Route::post('/assessment/{user}/show_for_admin', 'MakeQuestionnaireController@storeResult')->name('doresultTotlalScore');


Route::get('data_stored', 'DataStoredController@index')->name('data_stored.index');
Route::delete('/data_stored/{score}', 'DataStoredController@destroy')->name('data_stored.destroy');

Route::get('data_stored_comment', 'DataStoredCommentController@index')->name('data_stored_comment.index');
Route::delete('/data_stored_comment/{comment}', 'DataStoredCommentController@destroy')->name('data_stored_comment.destroy');
