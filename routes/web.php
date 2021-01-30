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

use App\Http\Controllers\BoardsController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;//変更箇所



Route::group(['prefix'=>'board','middleware'=>'auth'],function(){
    Route::get('index','BoardsController@index')->name('board.index');
    Route::get('create','BoardsController@create')->name('board.create');
    Route::post('store','BoardsController@store')->name('board.store');
    Route::get('show/{id}','BoardsController@show')->name('board.show');
    Route::get('edit/{id}','BoardsController@edit')->name('board.edit');
    Route::post('update/{id}','BoardsController@update')->name('board.update');
});

Route::group(['prefix'=>'comment','middleware'=>'auth'],function (){
    Route::post('store',"CommentsController@store")->name('comment.store');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
