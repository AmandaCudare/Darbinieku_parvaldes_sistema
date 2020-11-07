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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-only',function($user){
            return $user->Role == '1';
         
         });

        Gate::define('user-only',function($user){
            return ($user->Role == 2 || $user->Role == 3);
        });

        Gate::define('manager-only',function($user){
            return ($user->Role == 3);
        });
       
    }
}
