<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('access-administration', function ($user){
            return $user->tipo == 'A' || $user->tipo == 'F';
        });

        Gate::define('developer', function ($user){
           return $user->name == 'admin';
        });

        Gate::define('viewCharts', function($user){
            return $user->tipo == 'A';;
        });

        //
    }
}
