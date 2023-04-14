<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\EntryRepositoryInterface;
use App\Repositories\EntryRepository;

/**
 * Class RepositoryServiceProvider
 *
 * @author Andy Chang<softdev1114@gmail.com>
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(EntryRepositoryInterface::class, EntryRepository::class);
    }
}
