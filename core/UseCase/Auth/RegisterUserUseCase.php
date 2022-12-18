<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\AccessToken;
use Core\BusinessRules\Auth\CreateUserInterface;
use Core\BusinessRules\Auth\LoginUserInterface;
use Core\BusinessRules\Auth\UserCreateRequest;

class RegisterUserUseCase
{
    private CreateUserInterface $createUser;
    private LoginUserInterface $loginUser;

    public function __construct(
        CreateUserInterface $createUser,
        LoginUserInterface $loginUser
    ) {
        $this->createUser = $createUser;
        $this->loginUser = $loginUser;
    }

    public function register(UserCreateRequest $userCreateRequest): AccessToken
    {
        $userId = $this->createUser->create($userCreateRequest);

        return $this->loginUser->login($userId);
    }
}