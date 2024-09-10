<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB; // Thêm dòng này
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('DB_LOGGING', false)) {
            DB::listen(function ($query) {
                Log::info('Query: '.$query->sql);
                \Log::info('Bindings: '.json_encode($query->bindings));
                \Log::info('Time: '.$query->time.'ms');
            });
        }
    }
}
