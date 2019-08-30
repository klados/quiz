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


Route::get('/my_quizzes', 'Create_quizController@index')->name('my_quizzes');

Route::get('/create_quiz', 'Create_quizController@create')->name('create_quiz');
Route::post('/store','Create_quizController@store')->name('store');

Route::get('/show_edit_quiz/{id}', 'Create_quizController@edit')->name('show_edit_quiz');
Route::post('/update_quiz','Create_quizController@update')->name('update_quiz');

Route::get('/delete_quiz/{id}', 'Create_quizController@delete')->name('delete_quiz');


Route::get('/browse_quizzes', 'Solve_quizController@index')->name('browse_quizzes');

Route::get('/solve_quiz/{id}', 'Solve_quizController@show')->name('solve_quiz');
Route::post('/calculate_result', 'Solve_quizController@store')->name('calculate_result');

Route::get('/show_results', 'Solve_quizController@result')->name('show_results_of_a_user');
Route::get('/show_quiz_results/{id}', 'Solve_quizController@quiz_result')->name('show_results_of_a_quiz');
