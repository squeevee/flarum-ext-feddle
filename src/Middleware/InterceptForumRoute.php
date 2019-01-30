<?php

namespace Squeevee\Feddle\Middleware;

require_once __DIR__ . '/../../lib/AcceptHeader.php';

use \AcceptHeader;

use Squeevee\Feddle\Controllers\ActivityPubControllerAdapter;

use FastRoute\Dispatcher;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Server\MiddlewareInterface as Middleware;

class InterceptForumRoute implements Middleware
{
    private $controller;

    private const LD_MIME_A =     'application';
    private const LD_MIME_B =     'ld+json';
    private const PROFILE_PARAM = 'profile';
    private const PROFILE_VALUE = 'https://www.w3.org/ns/activitystreams';

    private const ACTIVITY_MIME_A = 'application';
    private const ACTIVITY_MIME_B = 'activity+json';

    public function __construct(ActivityPubControllerAdapter $controller)
    {
        $this->controller = $controller;
    }

    public function process(Request $request, Handler $fallback): Response
    {
        if ($this->isForActivityStreams($request))
        {
            return $this->controller->handle($request);
        }
        return $fallback->handle($request);
    }
    
    /**
     * ActivityPub W3C Recommendation
     * https://www.w3.org/TR/activitypub/#retrieving-objects
     * 
     * 3.2
     * 
     * Servers MAY use HTTP content negotiation as defined in [RFC7231] to
     * select the type of data to return in response to a request, but MUST
     * present the ActivityStreams object representation in response to
     * application/ld+json; profile="https://www.w3.org/ns/activitystreams",
     * and SHOULD also present the ActivityStreams representation in
     * response to application/activity+json as well.
    */
    
    private function isForActivityStreams($request)
    {
        $acceptString = $request->getServerParams()['HTTP_ACCEPT'];
        $accept = new AcceptHeader($acceptString);

        foreach ($accept as $item) 
        {
            if (strtolower($item['type']) === self::LD_MIME_A
                && strtolower($item['subtype'] === self::LD_MIME_B))
            {
                foreach($item['params'] as $name => $value)
                {
                    if (strtolower($name) === self::PROFILE_PARAM
                        && trim($value, '"\'') === self::PROFILE_VALUE)
                        return true;
                }
            }

            if (strtolower($item['type']) === self::ACTIVITY_MIME_A
                && strtolower($item['subtype']) === self::ACTIVITY_MIME_B)
            {
                return true;
            }
        }
        return false;
    }
}