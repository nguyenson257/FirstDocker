<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        Gate::define('show-sports', function ($user) {
            if ($user->role_id == 1) {
                return 'admin';
            } elseif ($user->role_id == 2) {
                return true;
            } else {
                return false;
            };
        });
        Gate::define('check-sports', function ($user, $user_id) {
            if ($user->id == $user_id)
                return true;
            else
                return false;
        });
        //
    }
}
