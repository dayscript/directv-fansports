<?php

namespace App\Providers;

use App\League;
use App\Policies\LeaguePolicy;
use App\Policies\PredictionPolicy;
use App\Prediction;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Prediction::class => PredictionPolicy::class,
        League::class => LeaguePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
