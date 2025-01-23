<?php

namespace App\Providers;

use App\Events\OrderStatusUpdated;
use App\Interface\CategoryInterface;
use App\Interface\PermissionInterface;
use App\Interface\PiutangInterface;
use App\Interface\ProductInterface;
use App\Interface\RoleInterface;
use App\Interface\UserInterface;
use App\Listeners\SendOrderNotification;
use App\Repository\CategoryRepository;
use App\Repository\PermissionRepository;
use App\Repository\PiutangRepository;
use App\Repository\ProductRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ProductInterface::class, ProductRepository::class);
        $this->app->singleton(CategoryInterface::class, CategoryRepository::class);
        $this->app->singleton(UserInterface::class, UserRepository::class);
        $this->app->singleton(RoleInterface::class, RoleRepository::class);
        $this->app->singleton(PermissionInterface::class, PermissionRepository::class);
        $this->app->singleton(PiutangInterface::class, PiutangRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Event::listen(
        //     OrderStatusUpdated::class,
        //     SendOrderNotification::class,
        // );
    }
}
