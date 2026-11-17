<?php

namespace ITMOSOFT\Procurement;

use Illuminate\Support\ServiceProvider;

class ProcurementServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/procurement.php', 'itmosoft-procurement');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/procurement.php' => config_path('procurement.php'),
        ], 'procurement-config');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
