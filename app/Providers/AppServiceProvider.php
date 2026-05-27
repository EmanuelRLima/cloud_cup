<?php

namespace App\Providers;

use App\Models\WorldCupMatch;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        // Bind {match} route parameter to WorldCupMatch
        Route::bind('match', fn ($value) => WorldCupMatch::findOrFail($value));
    }
}
