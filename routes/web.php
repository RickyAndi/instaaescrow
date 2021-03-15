<?php

use App\Http\Controllers\Development\DevelopmentUserLoginAction;
use App\Http\Controllers\Marketplace\Auth\UserLogoutAction;
use App\Http\Controllers\Marketplace\ShowIndexPageAction;
use App\Http\Controllers\Marketplace\ShowOrderBookAction;
use Illuminate\Routing\Router;
use App\Http\Controllers\OAuth\Google\RedirectToGoogleAction;
use App\Http\Controllers\OAuth\Google\HandleCallbackAction;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if (!App::environment('production')) {
    Route::group(['prefix' => 'development'], function (Router $route) {
        $route->get('/login', DevelopmentUserLoginAction::class)
            ->name('development.login');
    });
}

Route::group(['prefix' => 'oauth'], function (Router $route) {
   Route::group(['prefix' => 'google'], function (Router $route) {
       $route->get('redirect',RedirectToGoogleAction::class)
           ->name('oauth.google.redirect');
       $route->get('callback', HandleCallbackAction::class)
           ->name('oauth.google.callback');
   });
});


Route::get('/', ShowIndexPageAction::class)
    ->name('marketplace.index');
Route::get('/order-book', ShowOrderBookAction::class)
    ->name('marketplace.order-book');
Route::get('/logout', UserLogoutAction::class)
    ->name('marketplace.logout');

require __DIR__ . '/admin.php';