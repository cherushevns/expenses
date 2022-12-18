<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\CreateUserInterface;
use Core\BusinessRules\Auth\UserCreateRequest;
use Core\Infrastructure\DataAccessors\Database\User\UserRepository;
use Core\Interactors\Auth\Model\UserModel;

class CreateUserAction implements CreateUserInterface
{
    private UserRepository $userRepository;
    private UserModel $userModel;

    public function __construct(
        UserRepository $userRepository,
        UserModel $userModel
    ) {
        $this->userRepository = $userRepository;
        $this->userModel = $userModel;
    }

    public function create(UserCreateRequest $userCreateRequest): int
    {
        return $this->userRepository->create(
            $this->userModel->toDb($userCreateRequest)
        );
    }
}