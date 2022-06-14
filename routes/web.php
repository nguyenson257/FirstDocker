<?php

use App\Models\Sport;
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

Route::get('/','SportController@index');

Route::resource('sports','SportController');

Route::get('/delete/{id}','SportController@delete');

Route::get('/detail/{id}','SportController@detail');

Route::get('/add-sport','SportController@add_sport');

Route::get('/edit-sport/{id}','SportController@edit_sport');

Route::post('/save','SportController@save');

Route::post('/update','SportController@update');

Route::delete('/deleteimage/{id}','SportController@deleteimage');
Route::delete('/deletecover/{id}','SportController@deletecover');


Route::post('sport/search-advance', 'SportController@getSportSearch');