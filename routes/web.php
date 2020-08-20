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

/*
 * Everything from this point below is after the loginpage
 */
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/people', "PeopleController@updatePeople")->name('people.index');
    Route::post('/planets', "PlanetController@updatePlanets")->name('planets.index');
    Route::post('/species', "SpeciesController@updateSpecies")->name('species.index');

    Route::get('/overview', "OverviewController@index")->name('layouts.overview.index');
    Route::post('/overview', "SearchPeopleController@searchPerson")->name('layouts.overview.index');
});





