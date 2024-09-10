<?php 
use Illuminate\Support\Facades\Route;
use Modules\Policy\src\Models\Policy;


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::prefix('policy')->name('policy.')->middleware('can:policy')->group(function(){
        Route::get('/', 'PolicyController@index')->name('index');
        Route::post('/upload', 'PolicyController@uploadImage')->name('upload');
        Route::get('/edit', 'PolicyController@edit')->name('edit')->can('update', Policy::class);
        Route::post('/edit', 'PolicyController@update')->name('update')->can('update', Policy::class);
    });
});




Route::group(['as' => 'agents.'], function(){
    Route::group(['prefix' => 'chinh-sach' ,'as' => 'policy.', 'middleware' => ['auth:agents', 'user.block']], function(){
         Route::get('/', 'Clients\ClientPolicyController@index')->name('index');
    });
 });