<?php
use Illuminate\Support\Facades\Route;
use Modules\Groups\src\Models\Groups;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::prefix('Groups')->name('groups.')->middleware('can:groups')->group(function(){
        Route::get('/', 'GroupsController@index')->name('index')->can('viewAny', Groups::class);
        Route::get('/create', 'GroupsController@create')->name('create')->can('create', Groups::class);
        Route::post('/create', 'GroupsController@store')->name('store')->can('create', Groups::class);
        Route::get('/data', 'GroupsController@data')->name('data');
        Route::get('/edit/{group}', 'GroupsController@edit')->name('edit')->can('update', Groups::class);
        Route::post('/edit/{group}', 'GroupsController@update')->name('update')->can('update', Groups::class);
        Route::get('/permissions/{group}', 'GroupsController@permissions')->name('permissions')->can('permission', Groups::class);
        Route::post('/permissions/{group}', 'GroupsController@postPermissions')->can('permission', Groups::class);
        Route::post('/delete/{group}', 'GroupsController@delete')->name('delete');
    });
});














