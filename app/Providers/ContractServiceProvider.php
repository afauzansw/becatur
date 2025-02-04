<?php

namespace App\Providers;

use App\Contract\Auth\AdminAuthContract;
use App\Contract\Auth\DriverAuthContract;
use App\Contract\Auth\UserAuthContract;
use App\Contract\AuthBaseContract;
use App\Contract\BaseContract;
use App\Contract\Reservation\ReservationContract;
use App\Service\Auth\AdminAuthService;
use App\Service\Auth\DriverAuthService;
use App\Service\Auth\UserAuthService;
use App\Service\AuthBaseService;
use App\Service\BaseService;
use App\Service\Reservation\ReservationService;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /**
         * Base Service Contract.
         */
        $this->app->bind(BaseContract::class, BaseService::class);
        $this->app->bind(AuthBaseContract::class, AuthBaseService::class);


        /**
         * Auth Service Contract.
         */
        $this->app->bind(UserAuthContract::class, UserAuthService::class);
        $this->app->bind(DriverAuthContract::class, DriverAuthService::class);
        $this->app->bind(AdminAuthContract::class, AdminAuthService::class);

        $this->app->bind(ReservationContract::class, ReservationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
