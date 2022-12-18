<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\LogoutUserInterface;
use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;

class LogoutUserUseCase
{
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;
    private LogoutUserInterface $logoutUser;

    public function __construct(
        GetAuthorizedUserIdInterface $getAuthorizedUserId,
        LogoutUserInterface $logoutUser
    ) {
        $this->getAuthorizedUserId = $getAuthorizedUserId;
        $this->logoutUser = $logoutUser;
    }

    public function logout(): void
    {
        $userId = $this->getAuthorizedUserId->get();
        $this->logoutUser->logout($userId);
    }
}