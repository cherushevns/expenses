<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\CheckIsUserExistsByLoginInterface;
use Core\Infrastructure\DataAccessors\Database\User\UserRepository;

class CheckIsUserExistsByLoginAction implements CheckIsUserExistsByLoginInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function check(string $login): bool
    {
        $user = $this->userRepository->getByLogin($login);
        return ! is_null($user);
    }
}