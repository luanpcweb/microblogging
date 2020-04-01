<?php

namespace App\Providers;

use App\Repositories\TweetRepository;
use App\Repositories\Interfaces\TweetRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TweetRepositoryInterface::class,
            TweetRepository::class
        );
    }
}
