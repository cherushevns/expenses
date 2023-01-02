<?php

namespace Core\Interactors\Common\Auth;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenRepository;
use RuntimeException;
use DateTimeImmutable;
use Slim\Psr7\Factory\ServerRequestFactory;

class GetAuthorizedUserIdAction implements GetAuthorizedUserIdInterface
{
    public function __construct(
        private AccessTokenRepository $accessTokenRepository
    ) {}

    public function get(): int
    {
        $request = ServerRequestFactory::createFromGlobals();
        $accessTokenHeader = $request->getHeaderLine('Access-Token');
        if (empty($accessTokenHeader)) {
            throw new RuntimeException('User is undefined');
        }

        $accessToken = $this->accessTokenRepository->getByToken($accessTokenHeader);
        if (! $accessToken) {
            throw new RuntimeException('Invalid access token');
        }

        if ($accessToken->getExpiresAt() < (new DateTimeImmutable())) {
            $this->accessTokenRepository->clearUserTokens($accessToken->getUserId());
            throw new RuntimeException('Access token is expired');
        }

        return $accessToken->getUserId();
    }
}