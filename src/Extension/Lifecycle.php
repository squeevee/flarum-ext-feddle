<?php

namespace Squeevee\Feddle\Extension;

use Squeevee\Feddle\ActivityPub\ActivityPubFactory;

use Flarum\Extend\LifecycleInterface;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class Lifecycle implements LifecycleInterface, ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        //do nothing
    }

    public function onEnable(Container $container, Extension $extension)
    {
        $activityPub = $container->make(ActivityPubFactory::class)->makeActivityPub();
        $activityPub->updateSchema();
    }

    public function onDisable(Container $container, Extension $extension)
    {

    }
}