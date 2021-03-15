<?php
use App\Http\Controllers\Admin\Auth\ShowAdminLoginFormAction;
use App\Http\Controllers\Admin\Auth\AdminLoginAction;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShowAdminIndexPageAction;

Route::group(['prefix' => 'admin'], function (Router $route) {
    $route->get('login', ShowAdminLoginFormAction::class)
        ->name('admin.login.form');
    $route->post('login', AdminLoginAction::class)
        ->name('admin.login');

    $route->middleware(['auth:admin'])
        ->group(function (Router $route) {
            $route->get('/', ShowAdminIndexPageAction::class)
                ->name('admin.home');
        });
});
