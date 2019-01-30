<?php

namespace Squeevee\Feddle\Controllers;

use Squeevee\Feddle\ActivityPub\ActivityPubFactory;

use ActivityPub\Controllers\GetController;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Zend\Diactoros\Response\EmptyResponse;

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

        try
        {
            $response = $this->activityPub->handle($_request);
            return (new PsrHttpFactory())->createResponse($response);
        }
        catch (HttpException $e)
        {
            return new EmptyResponse($e->getStatusCode());
        }
    }
}