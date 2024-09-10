<?php 
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/', 'DashboardController@index')->name('admin.dashboards');
    
});