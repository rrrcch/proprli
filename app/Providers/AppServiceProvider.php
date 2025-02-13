<?php

namespace App\Providers;

use App\Contracts\BuildingRepositoryInterface;
use App\Contracts\CommentRepositoryInterface;
use App\Contracts\TaskRepositoryInterface;
use App\Repositories\EloquentBuildingRepository;
use App\Repositories\EloquentCommentRepository;
use App\Repositories\EloquentTaskRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BuildingRepositoryInterface::class, EloquentBuildingRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, EloquentCommentRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
