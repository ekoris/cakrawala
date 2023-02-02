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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['namespace' => 'App\Http\Controllers', 'as' => 'admin.'], function() {
      Route::group(['prefix' => 'user','as' => 'user.'], function() {
          Route::get('/', 'UserController@index')->name('index');
          Route::get('create', 'UserController@create')->name('create');
          Route::post('store', 'UserController@store')->name('store');
          Route::get('/{id}/edit', 'UserController@edit')->name('edit');
          Route::post('/{id}/update', 'UserController@update')->name('update');
          Route::get('/{id}/delete', 'UserController@delete')->name('delete');
      });
    });
});
