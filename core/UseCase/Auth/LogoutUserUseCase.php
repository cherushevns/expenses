<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\LogoutUserInterface;
use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;

class LogoutUserUseCase
{
    public function __construct(
        private GetAuthorizedUserIdInterface $getAuthorizedUserId,
        private LogoutUserInterface $logoutUser
    ) {}

    public function logout(): void
    {
        $userId = $this->getAuthorizedUserId->get();
        $this->logoutUser->logout($userId);
    }
}