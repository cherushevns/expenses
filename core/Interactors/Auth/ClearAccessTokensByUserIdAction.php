<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\ClearAccessTokensByUserIdInterface;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenRepository;

class ClearAccessTokensByUserIdAction implements ClearAccessTokensByUserIdInterface
{
    private AccessTokenRepository $accessTokenRepository;

    public function __construct(AccessTokenRepository $accessTokenRepository)
    {
        $this->accessTokenRepository = $accessTokenRepository;
    }

    public function clear(int $userId): void
    {
        $this->accessTokenRepository->clearUserTokens($userId);
    }
}