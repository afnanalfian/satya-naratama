<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\QuestionKeyChanged::class => [
            \App\Listeners\RecalculateExamScores::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}