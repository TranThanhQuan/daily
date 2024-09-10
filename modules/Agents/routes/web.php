<?php

use Modules\Agents\src\Models\Agent;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::prefix('agents')->name('agents.')->middleware('can:agents')->group(function(){
        Route::get('/', 'AgentController@index')->name('index')->can('viewAny', Agent::class);
        Route::get('/create', 'AgentController@create')->name('create')->can('create', Agent::class);
        Route::post('/create', 'AgentController@store')->name('store')->can('create', Agent::class);
        
        Route::get('/data', 'AgentController@data')->name('data')->can('viewAny', Agent::class);
        Route::get('/detail/{agent}', 'AgentController@detail')->name('detail')->can('viewAny', Agent::class);

        Route::get('/edit/{agent}', 'AgentController@edit')->name('edit')->can('update', Agent::class);
        Route::post('/edit/{agent}', 'AgentController@update')->name('update')->can('update', Agent::class);
        Route::post('/delete/{agent}', 'AgentController@delete')->name('delete')->can('delete', Agent::class);
    });
});








Route::group(['as' => 'agents.'], function(){
   Route::group(['prefix' => 'tai-khoan' ,'as' => 'account.', 'middleware' => ['auth:agents', 'user.block']], function(){
        Route::get('/thong-tin', 'Clients\AccountController@profile')->name('account_profile');
        // Route::get('/doi-soat', 'Clients\AccountController@report')->name('account_report');

   });
});









