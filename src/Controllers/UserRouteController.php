<?php
namespace Squeevee\Feddle\Controllers;

use Flarum\Http\RouteHandlerFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Flarum\Http\Exception\RouteNotFoundException;
use Zend\Diactoros\Response\RedirectResponse;
use Flarum\Http\UrlGenerator;

class UserRouteController implements RequestHandlerInterface
{
    private $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $username = $request->getQueryParams()['username'];
        
        if (!$username)
        {
            throw new RouteNotFoundException();
        }

        $url = $this->urlGenerator->to('forum')->route('user', ['username' => $username ]);

        return new RedirectResponse($url);
    }
}