<?php

namespace App\Providers;

use App\Contract\Admin\AdminContract;
use App\Contract\Auth\AdminAuthContract;
use App\Contract\Auth\DriverAuthContract;
use App\Contract\Auth\UserAuthContract;
use App\Contract\AuthBaseContract;
use App\Contract\BaseContract;
use App\Contract\Driver\DriverContract;
use App\Contract\FireStoreContract;
use App\Contract\Reservation\ReservationContract;
use App\Contract\Setting\SettingContract;
use App\Service\Admin\AdminService;
use App\Service\Auth\AdminAuthService;
use App\Service\Auth\DriverAuthService;
use App\Service\Auth\UserAuthService;
use App\Service\AuthBaseService;
use App\Service\BaseService;
use App\Service\Driver\DriverService;
use App\Service\FireStoreService;
use App\Service\Reservation\ReservationService;
use App\Service\Setting\SettingService;
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
        $this->app->bind(FireStoreContract::class, FireStoreService::class);


        /**
         * Auth Service Contract.
         */
        $this->app->bind(UserAuthContract::class, UserAuthService::class);
        $this->app->bind(DriverAuthContract::class, DriverAuthService::class);
        $this->app->bind(AdminAuthContract::class, AdminAuthService::class);

        $this->app->bind(AdminContract::class, AdminService::class);
        $this->app->bind(DriverContract::class, DriverService::class);
        $this->app->bind(ReservationContract::class, ReservationService::class);
        $this->app->bind(SettingContract::class, SettingService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
