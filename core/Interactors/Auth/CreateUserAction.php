<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\CreateUserInterface;
use Core\BusinessRules\Auth\Entity\UserCreateRequest;
use Core\Infrastructure\DataAccessors\Database\User\UserRepository;
use Core\Interactors\Auth\Model\UserModel;

class CreateUserAction implements CreateUserInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private UserModel $userModel
    ) {}

    public function create(UserCreateRequest $userCreateRequest): int
    {
        return $this->userRepository->create(
            $this->userModel->toData($userCreateRequest)
        );
    }
}