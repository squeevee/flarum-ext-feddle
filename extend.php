<?php

namespace Squeevee\Feddle;

use Flarum\Extend;
use Flarum\Frontend\Document;
use Flarum\Foundation\Application;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
    (new Extend\Locales(__DIR__ . '/resources/locales') ),
    (new Extend\Routes('api'))
        ->get('/feddle/outbox', 'feddle.outbox', Controllers\ActivityPubControllerAdapter::class),
    (new Extend\Routes('api'))
        ->get('/feddle/inbox', 'feddle.inbox', Controllers\ActivityPubControllerAdapter::class),
    /*(new Extend\Routes('forum'))
        ->get('/@{username}[/{filter:[^/]*}]', 'feddle.user', Controllers\UserRouteControllerAdapter::class),*/
    function (Dispatcher $events, Application $app) {
        $app->register(ActivityPub\ActivityPubProvider::class);
    }
];