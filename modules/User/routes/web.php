<?php
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'],function(){
    Route::prefix('users')->name('users.')->middleware('can:users')->group(function(){
        Route::get('/', 'UserController@index')->name('index')->can('viewAny', User::class);
        Route::get('/create', 'UserController@create')->name('create')->can('create', User::class);
        Route::post('/create', 'UserController@store')->name('store')->can('create', User::class);
        Route::get('/data', 'UserController@data')->name('data');
        Route::get('/edit/{user}', 'UserController@edit')->name('edit');
        Route::post('/edit/{user}', 'UserController@update')->name('update');
        Route::post('/delete/{user}', 'UserController@delete')->name('delete');
    });
});













