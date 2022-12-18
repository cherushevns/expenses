<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\GetUserIdByLoginInterface;
use Core\Infrastructure\DataAccessors\Database\User\UserRepository;
use RuntimeException;

class GetUserIdByLoginAction implements GetUserIdByLoginInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get(string $login): int
    {
        $user = $this->userRepository->getByLogin($login);
        if (! $user || ! $user->getId()) {
            throw new RuntimeException('User doesn\'t exists');
        }

        return $user->getId();
    }
}