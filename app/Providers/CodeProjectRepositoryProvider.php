<?php

namespace CodeProject\Providers;

use Illuminate\Support\ServiceProvider;

class CodeProjectRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \CodeProject\Repositories\Contracts\ClientRepository::class,
            \CodeProject\Repositories\ClientRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\Contracts\ProjectRepository::class,
            \CodeProject\Repositories\ProjectRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\Contracts\ProjectNoteRepository::class,
            \CodeProject\Repositories\ProjectNoteRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\Contracts\ProjectTaskRepository::class,
            \CodeProject\Repositories\ProjectTaskRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeProject\Repositories\Contracts\UserRepository::class,
            \CodeProject\Repositories\UserRepositoryEloquent::class
        );
    }
}
