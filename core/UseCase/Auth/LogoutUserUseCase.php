<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\ClearAccessTokensByUserIdInterface;

class LogoutUserUseCase
{
    private ClearAccessTokensByUserIdInterface $clearAccessTokensByUserId;

    public function __construct(ClearAccessTokensByUserIdInterface $clearAccessTokensByUserId)
    {
        $this->clearAccessTokensByUserId = $clearAccessTokensByUserId;
    }

    public function logout(int $userId): void
    {
        $this->clearAccessTokensByUserId->clear($userId);
    }
}