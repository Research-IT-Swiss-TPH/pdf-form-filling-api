<?php
namespace App\Middleware;

use Odan\Session\SessionInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteContext;

final class LoginAuthMiddleware implements MiddlewareInterface
{
    private ResponseFactoryInterface $responseFactory;
    private SessionInterface $session;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        SessionInterface $session
    ) {
        $this->responseFactory = $responseFactory;
        $this->session = $session;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface{
        
        if ($this->session->get('user')) {


                    // User is not logged in. Redirect to login page.
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('dashboard');

        return $this->responseFactory->createResponse()
        ->withStatus(302)
        ->withHeader('Location', $url);
        
        }

        // User is logged in
        return $handler->handle($request);

    }
}