<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\AccessToken;
use Core\BusinessRules\Auth\ClearAccessTokensByUserIdInterface;
use Core\BusinessRules\Auth\GetUserIdByLoginInterface;
use Core\BusinessRules\Auth\LoginUserInterface;

class LoginUserUseCase
{
    private GetUserIdByLoginInterface $getUserIdByLogin;
    private ClearAccessTokensByUserIdInterface $clearAccessTokensByUserId;
    private LoginUserInterface $loginUser;

    public function __construct(
        GetUserIdByLoginInterface $getUserIdByLogin,
        ClearAccessTokensByUserIdInterface $clearAccessTokensByUserId,
        LoginUserInterface $loginUser
    ) {
        $this->getUserIdByLogin = $getUserIdByLogin;
        $this->clearAccessTokensByUserId = $clearAccessTokensByUserId;
        $this->loginUser = $loginUser;
    }

    public function login(string $login): AccessToken
    {
        $userId = $this->getUserIdByLogin->get($login);
        $this->clearAccessTokensByUserId->clear($userId);
        return $this->loginUser->login($userId);
    }
}