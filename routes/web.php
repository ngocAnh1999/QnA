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

Auth::routes();

Route::get('/admin','adminController@index')->name('admin');
Route::post('/admin/add','adminController@add')->name('addRole');
Route::post('/admin/edit','adminController@edit')->name('editRole');
// Route::post('/admin/delete','adminController@delete')->name('deleteRole');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/survey/statistic', 'StatisticController@show')->name('statistic');
Route::get('/survey/statistic/{id}','StatisticController@index')->name('indexStatistic');
Route::get('/survey/{selected}', 'SurveyController@index')->name('survey');
Route::post('/survey/create', 'SurveyController@create')->name('createSurvey');
Route::get('/survey/delete/{id}', 'SurveyController@delete')->name('deleteSurvey');

Route::get('/survey/new_survey/{id}', 'CreateSuveyController@show')->name('newSurvey');
Route::post('/survey/{id}/save', 'CreateSuveyController@saveQuestion')->name('saveQuestion');
Route::post('/survey/answer', 'AnswerSurveyController@answer')->name('answerSurvey');
Route::post('/survey/submitAnswer','AnswerSurveyController@submitAnswer')->name('submitAnswer');

Route::get('/qna/{selected}','QnAController@index')->name('qna');
Route::post('/qna/{selected}/add', 'QnAController@create')->name('addSession');
Route::post('/qna/{selected}/del', 'QnAController@delete')->name('deleteSession');
Route::post('/qna/{selected}/edit', 'QnAController@edit')->name('editSession');

Route::get('/qna/session/{id}', 'SessionController@show')->name('showQuestion');
Route::post('/qna/session/{id}/add', 'SessionController@create')->name('addQuestion');
Route::post('/qna/session/{id}/edit', 'SessionController@edit')->name('editQuestion');
Route::post('/qna/session/{id}/delete', 'SessionController@delete')->name('deleteQuestion');

Route::get('/qna/q/{id}', 'QuestionController@show')->name('ansQuestion');
Route::post('/qna/q/{id}/add', 'QuestionController@create')->name('addAnswer');
Route::post('/qna/q/{id}/edit', 'QuestionController@edit')->name('editAnswer');
Route::post('/qna/q/{id}/delete', 'QuestionController@delete')->name('delAnswer');

Route::get('/qna/q/{id}/accept', 'QuestionController@accept')->name('accept');
Route::get('/qna/q/{id}/deaccept', 'QuestionController@deaccept')->name('de_accept');