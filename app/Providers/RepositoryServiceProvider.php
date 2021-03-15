<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\OrderRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\OrderRepository\OrderRepository;
use App\Repositories\OrderRepository\OrderRepositoryInterface;
use App\Repositories\OrderRequestRepository\OrderRequestRepository;
use App\Repositories\OrderRequestRepository\OrderRequestRepositoryInterface;
use App\Repositories\RoleRepository\RoleRepository;
use App\Repositories\RoleRepository\RoleRepositoryInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            function (Application $application) {
                return new UserRepository(new User());
            }
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            function (Application $application) {
                return new RoleRepository(new Role());
            }
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            function (Application $application) {
                return new OrderRepository(new Order());
            }
        );

        $this->app->bind(
            OrderRequestRepositoryInterface::class,
            function (Application $application) {
                return new OrderRequestRepository(new OrderRequest());
            }
        );
    }
}
