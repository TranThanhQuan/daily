<?php
use Modules\Games\src\Models\Games;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::prefix('games')->name('games.')->middleware('can:games')->group(function(){
        Route::get('/', 'GamesController@index')->name('index');
        Route::get('/create', 'GamesController@create')->name('create')->can('create', Games::class);
        Route::post('/create', 'GamesController@store')->name('store')->can('create', Games::class);
        Route::get('/data', 'GamesController@data')->name('data');
        Route::get('/edit/{game}', 'GamesController@edit')->name('edit')->can('update', Games::class);
        Route::post('/edit/{game}', 'GamesController@update')->name('update')->can('update', Games::class);
        Route::post('/delete/{game}', 'GamesController@delete')->name('delete')->can('delete', Games::class);
    });
});


















