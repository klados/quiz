<?php

use Illuminate\Support\Facades\Auth;

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
	if (Auth::check()) {
  	// return view('home');
		return redirect()->route('home');
	}
	else{
  	return view('welcome');
	}

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create_quiz', 'Create_quizController@create')->name('create_quiz');
Route::post('/store','Create_quizController@store')->name('store');
Route::get('/solve_quiz/{id}', 'Create_quizController@show')->name('solve_quiz');
Route::get('/delete_quiz/{id}', 'Create_quizController@delete')->name('delete_quiz');


