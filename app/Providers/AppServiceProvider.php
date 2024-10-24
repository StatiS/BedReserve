<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        // This would be a global gate definition, to be used with can calls and such.
        // This time it is replaced with JobPolicy
        /*Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });*/

        // If you'd want to disable lazy loading
        // Model::preventLazyLoading();

        // If you'd want a laravel component to something else than the tailwind default
        // Paginator::useBootstrapFive();
    }
}
