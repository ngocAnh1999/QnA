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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/survey', 'SurveyController@index')->name('survey');
Route::get('/survey/create', 'SurveyController@create')->name('createSurvey');

Route::get('/qna/{select}','QnAController@index')->name('qna');
Route::post('/qna/add', 'QnAController@create')->name('addSession');
Route::post('/qna/del', 'QnAController@delete')->name('deleteSession');
Route::post('/qna/edit', 'QnAController@edit')->name('editSession');

Route::get('/qna/session/{id}', 'SessionController@show')->name('showQuestion');
Route::post('/qna/session/{id}/add', 'SessionController@create')->name('addQuestion');
Route::post('/qna/session/{id}/edit', 'SessionController@edit')->name('editQuestion');
Route::post('/qna/session/{id}/delete', 'SessionController@delete')->name('deleteQuestion');

Route::get('/qna/q/{id}', 'QuestionController@show')->name('ansQuestion');