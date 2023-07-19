<?php

namespace App\Providers;

use App\Repository\TeacherRepositoryInterface;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;


class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
