<?php

use Modules\Payments\src\Models\Payments;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::prefix('payments')->name('payments.')->middleware('can:payments')->group(function(){
        Route::get('/', 'PaymentsController@index')->name('index')->can('viewAny', Payments::class);
        Route::post('/', 'PaymentsController@update')->name('update');
        Route::get('/create', 'PaymentsController@create')->name('create')->can('create', Payments::class);
        Route::post('/create', 'PaymentsController@store')->name('store')->can('create', Payments::class);
        Route::get('/data', 'PaymentsController@data')->name('data')->can('viewAny', Payments::class);
        Route::get('/report', 'PaymentsController@report')->name('report')->can('report', Payments::class);
        Route::post('/report', 'PaymentsController@showReport')->name('showReport');
        Route::get('/export-report', 'PaymentsController@export')->name('export')->can('report', Payments::class);
    });
});

Route::group(['as' => 'payments.', 'middleware' => ['auth:agents', 'user.block']], function(){
    Route::get('/payments', 'Clients\PaymentsClientController@index')->name('index');
    Route::get('/payments/data', 'Clients\PaymentsClientController@data')->name('data');


});












