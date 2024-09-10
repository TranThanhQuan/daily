<?php

Route::prefix('home')->name('home.')->middleware('can:home')->group(function(){
    //Route gere

});
