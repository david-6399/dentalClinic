<?php

namespace App\Providers;

use App\Services\ClinicData;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Blaze\Blaze;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('c', ClinicData::all());

        Blaze::optimize()
            ->in(resource_path('views/components'));
    }
}
