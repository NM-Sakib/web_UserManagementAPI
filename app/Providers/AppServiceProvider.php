<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        $permissions = Permission::all();
        foreach($permissions as $permission)
        {
            Gate::define($permission->name, function(User $user) use($permission){
                $userRoles = $user->roles;
                foreach($userRoles as $ur) {
                    $perm = $ur->permissions->where('name', $permission->name)->first();
                    if($perm) return true;
                }

                return false;
            });
        }
    }
}
