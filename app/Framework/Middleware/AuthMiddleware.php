<?php

namespace App\Framework\Middleware;

use Core\BusinessRules\Auth\ClearAccessTokensByUserIdInterface;
use Core\BusinessRules\Auth\GetAccessTokenByTokenInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpForbiddenException;

class AuthMiddleware implements MiddlewareInterface
{
    private GetAccessTokenByTokenInterface $getUserIdByToken;
    private ClearAccessTokensByUserIdInterface $clearAccessTokensByUserId;

    public function __construct(
        GetAccessTokenByTokenInterface $getUserIdByToken,
        ClearAccessTokensByUserIdInterface $clearAccessTokensByUserId
    ) {
        $this->getUserIdByToken = $getUserIdByToken;
        $this->clearAccessTokensByUserId = $clearAccessTokensByUserId;
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

        if (empty($request->getHeader('Access-Token'))) {
            throw new HttpForbiddenException($request);
        }

        $accessToken = $this->getUserIdByToken->get($request->getHeaderLine('Access-Token'));

        if (! $accessToken) {
            throw new HttpForbiddenException($request);
        }

        if ($accessToken->getTtl() <= 0) {
            $this->clearAccessTokensByUserId->clear($accessToken->getUserId());
            throw new HttpForbiddenException($request);
        }

        $request = $request->withAttribute('userId', $accessToken->getUserId());
        return $handler->handle($request);
    }
}