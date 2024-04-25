<?php

namespace App\Providers;

use App\Repositories\Implementations\AdminRepository;
use App\Repositories\Implementations\CategoryRepository;
use App\Repositories\Implementations\JobsRepository;
use App\Repositories\Implementations\ReportEmployeeRepository;
use App\Repositories\Interfaces\AdminInterface;
use App\Repositories\Interfaces\CategoryJobInterface;
use App\Repositories\Interfaces\JobsInterface;
use App\Repositories\Interfaces\ReportEmployeeInterface;
use App\Services\Implementations\AdminService;
use App\Services\Implementations\CategoryJobService;
use App\Services\Implementations\JobService;
use App\Services\Implementations\ReportEmployeeService;
use App\Services\Interfaces\AdminServiceInterface;
use App\Services\Interfaces\CategoryJobServiceInterface;
use App\Services\Interfaces\JobsServiceInterface;
use App\Services\Interfaces\ReportEmployeeServiceInterface;
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
        app()->bind(CategoryJobInterface::class,CategoryRepository::class);
        app()->bind(CategoryJobServiceInterface::class,CategoryJobService::class);
        app()->bind(ReportEmployeeInterface::class,ReportEmployeeRepository::class);
        app()->bind(ReportEmployeeServiceInterface::class,ReportEmployeeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        paginator::useBootstrap();
    }
}
