<?php

namespace Squeevee\Feddle\Controllers;

use Squeevee\Feddle\ActivityPub\ActivityPubFactory;

use ActivityPub\Controllers\GetController;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class ActivityPubControllerAdapter implements RequestHandlerInterface
{
    public function __construct(ActivityPubFactory $apFactory)
    {
        $this->activityPub = $apFactory->makeActivityPub();
    }

    private $activityPub;

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $_request = (new HttpFoundationFactory())->createRequest($request);

        $response = $this->activityPub->handle($_request);
        return (new PsrHttpFactory())->createResponse($response);
    }
}