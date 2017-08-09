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
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('home');
Route::get('como-jugar', 'HomeController@instructions');
Route::get('terminos-y-condiciones', 'HomeController@terms');
Route::get('politica-de-privacidad', 'HomeController@privacy');
Route::get('soporte', 'HomeController@support');
Route::get('pronosticos', 'HomeController@game');
Route::get('ligas', 'HomeController@ligas');
Route::get('ranking', 'HomeController@ranking');
Route::resource('users','UsersController');

Route::any('roundmatches/{round}','MatchesController@roundmatches');
Route::get('predictions/{match}/calculatepoints','MatchesController@calculatepoints');
Route::get('matches/{match}/updatescore','MatchesController@updatescore');
Route::post('predictions/{match}/update','MatchesController@updatePrediction');
Route::post('rankingdata/{page}','UsersController@ranking');
Route::post('leagues/{league}/leave','UsersController@leaveLeague');
Route::post('leagues/{league}/invite','UsersController@inviteLeague');
Route::post('leagues/join','UsersController@joinLeague');
Route::post('leagues','UsersController@createLeague');
Route::put('leagues/{league}','UsersController@updateLeague');
Route::delete('leagues/{league}','UsersController@deleteLeague');
Route::post('contact','HomeController@contact');
Route::get('mi-cuenta','UsersController@account');
Route::post('users/updatepassword','UsersController@updatePassword');
Route::post('codes/apply','UsersController@applyCode');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
