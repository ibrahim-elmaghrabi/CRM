<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\{
    NoteRepository,
    UserRepository,
    InvoiceRepository,
    ProjectRepository,
    CustomerRepository,
};
 use App\Repositories\Contracts\{
    UserRepositoryContract,
    InvoiceRepositoryContract,
    ProjectRepositoryContract,
    CustomerRepositoryContract,
    NoteRepositoryContract,
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryContract::class, CustomerRepository::class);
        $this->app->bind(NoteRepositoryContract::class, NoteRepository::class);
        $this->app->bind(InvoiceRepositoryContract::class, InvoiceRepository::class);
        $this->app->bind(ProjectRepositoryContract::class, ProjectRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
