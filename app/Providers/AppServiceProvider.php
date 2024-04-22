<?php

namespace App\Providers;

use App\Repositories\Implementations\AdminRepository;
use App\Repositories\Implementations\JobsRepository;
use App\Repositories\Interfaces\AdminInterface;
use App\Repositories\Interfaces\JobsInterface;
use App\Services\Implementations\AdminService;
use App\Services\Implementations\JobService;
use App\Services\Interfaces\AdminServiceInterface;
use App\Services\Interfaces\JobsServiceInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(JobsInterface::class,JobsRepository::class);
        app()->bind(JobsServiceInterface::class,JobService::class);
        app()->bind(AdminInterface::class,AdminRepository::class);
        app()->bind(AdminServiceInterface::class,AdminService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        paginator::useBootstrap();
    }
}
