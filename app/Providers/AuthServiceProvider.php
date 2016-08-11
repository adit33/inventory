<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Permission;
use App\Barang;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */

     public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /**
         * NOTE!!
         * First time migration will fails, because permissions table doesn't exists.
         */

        foreach($this->getPermissions() as $permission) {
            $gate->define($permission->namaPermission, function($user) use ($permission) {
                return $user->hasRole($permission->r_role);
            });
        }
    }

    private function getPermissions()
    {
        return Permission::all();
    }
}
