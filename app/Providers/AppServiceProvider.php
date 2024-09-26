<?php

namespace App\Providers;

use App\Repositories\LuckyHistory\LuckyHistoryRepository;
use App\Repositories\LuckyHistory\LuckyHistoryRepositoryInterface;
use App\Repositories\Player\PlayerRepository;
use App\Repositories\Player\PlayerRepositoryInterface;
use App\Services\Prizes\PrizeService;
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
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
        $this->app->bind(LuckyHistoryRepositoryInterface::class, LuckyHistoryRepository::class);
        $this->app->singleton(PrizeService::class, function ($app) {
            return new PrizeService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
