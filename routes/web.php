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

/*
Route::get('/hero/{id}', 'SuperHeroController@show')->name('hero.show');
Route::get('/hero/create', 'SuperHeroController@create')->name('hero.create');*/
Route::get('/', 'SuperHeroController@index');
Route::resource('hero', 'SuperHeroController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
