<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Logout;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Logout::class => [
            // Pas de listener pour le moment, mais ici tu peux ajouter si besoin
        ],
    ];

    public function boot()
    {
        //
    }
}
