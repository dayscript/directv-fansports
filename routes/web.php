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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('como-jugar', 'HomeController@instructions');
Route::get('terminos-y-condiciones', 'HomeController@terms');
Route::get('politica-de-privacidad', 'HomeController@privacy');
Route::get('soporte', 'HomeController@support');
Route::get('pronosticos', 'HomeController@game');
Route::get('ligas', 'HomeController@ligas');
Route::get('ranking', 'HomeController@ranking');
Route::resource('users','UsersController');

Route::get('roundmatches/{round}','MatchesController@roundmatches');
Route::get('predictions/{match}/calculatepoints','MatchesController@calculatepoints');
Route::get('matches/{match}/updatescore','MatchesController@updatescore');
Route::post('predictions/{match}/update','MatchesController@updatePrediction');
Route::post('rankingdata/{page}','UsersController@ranking');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
