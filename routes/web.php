<?php

use App\Models\Sport;
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

Route::get('/', function() {    return view('login');});

Route::resource('sports','SportController')->middleware('auth');

Route::get('/delete/{id}','SportController@delete')->middleware('auth');

Route::get('/detail/{id}','SportController@detail')->middleware('auth');

Route::get('/add-sport','SportController@add_sport')->middleware('auth');

Route::get('/edit-sport/{id}','SportController@edit_sport')->middleware('auth');

Route::post('/save','SportController@save')->middleware('auth');

Route::post('/update','SportController@update')->middleware('auth');

Route::delete('/deleteimage/{id}','SportController@deleteimage')->middleware('auth');
Route::delete('/deletecover/{id}','SportController@deletecover')->middleware('auth');


Route::post('sport/search-advance', 'SportController@getSportSearch')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
