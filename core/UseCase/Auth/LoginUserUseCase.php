<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\AccessToken;
use Core\BusinessRules\Auth\ClearAccessTokensByUserIdInterface;
use Core\BusinessRules\Auth\GetUserIdByLoginInterface;
use Core\BusinessRules\Auth\LoginUserInterface;

class LoginUserUseCase
{
    private GetUserIdByLoginInterface $getUserIdByLogin;
    private LoginUserInterface $loginUser;

    public function __construct(
        GetUserIdByLoginInterface $getUserIdByLogin,
        LoginUserInterface $loginUser
    ) {
        $this->getUserIdByLogin = $getUserIdByLogin;
        $this->loginUser = $loginUser;
    }

    public function login(string $login): AccessToken
    {
        $userId = $this->getUserIdByLogin->get($login);
        return $this->loginUser->login($userId);
    }
}