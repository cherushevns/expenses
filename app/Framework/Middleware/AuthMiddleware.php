<?php

namespace App\Framework\Middleware;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpForbiddenException;
use Throwable;

class AuthMiddleware implements MiddlewareInterface
{
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;

    public function __construct(
        GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {
        $this->getAuthorizedUserId = $getAuthorizedUserId;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // @todo подумать над этим говном, может есть как в симфони аттрибуты у роутов?
        if ( in_array($request->getRequestTarget(), [
            '/v1/auth/login',
            '/v1/auth/register'
        ])) {
            return $handler->handle($request);
        }

        try {
            $this->getAuthorizedUserId->get();
        } catch (Throwable $t) {
            throw new HttpForbiddenException($request);
        }

        return $handler->handle($request);
    }
}