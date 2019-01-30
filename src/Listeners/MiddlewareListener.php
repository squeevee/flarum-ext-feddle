<?php

namespace Squeevee\Feddle\Listeners;

use Squeevee\Feddle\Middleware\InterceptForumRoute;

use Flarum\Event\ConfigureMiddleware;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Foundation\Application;

class MiddlewareListener
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureMiddleware::class, [$this, 'configureMiddleware']);
    }

    public function configureMiddleware(ConfigureMiddleware $event)
    {
        if ($event->isForum())
        {
            $event->pipe($this->app->make(InterceptForumRoute::class));
        }
    }
}