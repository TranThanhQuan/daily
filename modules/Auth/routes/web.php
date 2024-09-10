<?php 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes([
    'register' => false,
]);


Route::get('/login', 'admin\LoginController@showLoginForm')->name('login');
Route::post('/login', 'admin\LoginController@login');
Route::post('/logout', 'admin\LoginController@logout')->name('logout');


Route::get('/dang-nhap', 'clients\LoginController@showLoginForm')->name('clients.login');
Route::post('/dang-nhap', 'clients\LoginController@login');
Route::post('/dang-xuat', 'clients\LoginController@logout')->name('clients.logout');

Route::get('/block', 'clients\BlockController@index')->name('clients.block.index')->middleware('auth:agents');
