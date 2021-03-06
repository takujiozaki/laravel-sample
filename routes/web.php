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

// Route::get('/', function () {
//     return view('books/show');
// });

// Route::get('/create', function(){
//     return view('books/create');
// });

Route::get('/', 'BookController@show');

Route::get('/create', 'BookController@create');
Route::post('/create', 'BookController@store');

Route::get('/edit{id}', 'BookController@edit');
Route::post('/edit{id}', 'BookController@update');

Route::get('/delete{id}', 'BookController@delete');
Route::post('/delete{id}', 'BookController@remove');