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

        Gate::define('registrar-venta', function ($user) {
            return $user->perfil->nombre === 'VENDEDOR';
        });

        Gate::define('asignar-operador', function ($user) {
            return $user->perfil->nombre === 'COORDINADOR';
        });

        Gate::define('cerrar-servicio', function ($user, $servicio) {
            return $user->id === $servicio->operador_id
                and ($user->perfil->nombre === 'ESPECIALISTA' or $user->perfil->nombre === 'TRANSPORTISTA');
        });
    }
}
