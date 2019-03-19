<?php

namespace Squeevee\Feddle\ActivityPub;

use Flarum\Foundation\AbstractServiceProvider;
use Illuminate\Contracts\Container\Container;

class ActivityPubProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->app->singleton(ActivityPubFactory::class);
    }
}