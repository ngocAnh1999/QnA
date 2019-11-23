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
<<<<<<< HEAD
Route::post('/qna', 'QnAController@create')->name('addSession');
Route::post('/qna/del', 'QnAController@delete')->name('deleteSession');
=======
Route::post('/qna/add', 'QnAController@create')->name('addSession');
Route::post('/qna/del', 'QnAController@delete')->name('deleteSession');
Route::post('/qna/edit', 'QnAController@edit')->name('editSession');
>>>>>>> cf53403c65e2a93ad6ffa384b030fd52bac30023
