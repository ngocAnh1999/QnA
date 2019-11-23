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
Route::get('/qna', 'QnAController@index')->name('qna');
Route::post('/qna', 'QnAController@create')->name('addSession');
Route::post('/qna/del', 'QnAController@delete')->name('deleteSession');