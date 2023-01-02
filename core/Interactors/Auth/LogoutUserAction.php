<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\LogoutUserInterface;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenRepository;

class LogoutUserAction implements LogoutUserInterface
{
    public function __construct(
        private AccessTokenRepository $accessTokenRepository
    ) {}

    public function logout(int $userId): void
    {
        $this->accessTokenRepository->clearUserTokens($userId);
    }
}