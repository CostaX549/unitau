<?php

namespace App\Providers;
use App\Models\Tarefa;
use App\Policies\TaskPolicy;
use App\Policies\EquipePolicy;
use App\Models\Equipe;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tarefa::class => TaskPolicy::class,
        Equipe::class =>EquipePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
