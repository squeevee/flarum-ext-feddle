<?php
namespace Squeevee\Feddle\Controllers;

use Flarum\Http\RouteHandlerFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\RedirectResponse;

class UserRouteControllerAdapter implements RequestHandlerInterface
{
    private $ap_adapter;

    public function __construct(ActivityPubControllerAdapter $ap_adapter)
    {
        $this->ap_adapter = $ap_adapter;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        if ( in_array( $_SERVER['HTTP_ACCEPT'],
               array( 'application/ld+json', 'application/activity+json' ) ) )
        {
            return $this->ap_adapter->handle($request);
        }
        else
        {
            
            return new RedirectResponse('http://dev.floofgrotto.localhost/forum/u/admin');
        }
    }
}