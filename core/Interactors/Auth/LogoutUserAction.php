<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\LogoutUserInterface;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenRepository;

class LogoutUserAction implements LogoutUserInterface
{
    private AccessTokenRepository $accessTokenRepository;

    public function __construct(
        AccessTokenRepository $accessTokenRepository
    ) {
        $this->accessTokenRepository = $accessTokenRepository;
    }

    public function logout(int $userId): void
    {
        $this->accessTokenRepository->clearUserTokens($userId);
    }
}