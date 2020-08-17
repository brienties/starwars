<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/peoples', "PeopleController@index")->name('peoples.index')->middleware('auth');
Route::get('/planets', "PlanetController@index")->name('planets.index')->middleware('auth');
Route::get('/species', "SpeciesController@index")->name('species.index')->middleware('auth');



