<?php

namespace Squeevee\Feddle\ActivityPub;

use Flarum\Foundation\AbstractServiceProvider;

class ActivityPubProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->app->make(ActivityPubFactory::class);
    }
}