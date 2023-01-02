<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\Entity\AccessToken;
use Core\BusinessRules\Auth\GetUserIdByLoginInterface;
use Core\BusinessRules\Auth\LoginUserInterface;

class LoginUserUseCase
{
    public function __construct(
        private GetUserIdByLoginInterface $getUserIdByLogin,
        private LoginUserInterface $loginUser
    ) {}

    public function login(string $login): AccessToken
    {
        $userId = $this->getUserIdByLogin->get($login);
        return $this->loginUser->login($userId);
    }
}