<?php

namespace Core\UseCase\Auth;

use Core\BusinessRules\Auth\CreateUserInterface;
use Core\BusinessRules\Auth\Entity\AccessToken;
use Core\BusinessRules\Auth\Entity\UserCreateRequest;
use Core\BusinessRules\Auth\LoginUserInterface;

class RegisterUserUseCase
{
    public function __construct(
        private CreateUserInterface $createUser,
        private LoginUserInterface $loginUser
    ) {}

    public function register(UserCreateRequest $userCreateRequest): AccessToken
    {
        $userId = $this->createUser->create($userCreateRequest);

        return $this->loginUser->login($userId);
    }
}