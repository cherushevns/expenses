<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\ValidateUserPasswordInterface;
use Core\Infrastructure\DataAccessors\Database\User\UserRepository;
use Core\Infrastructure\Password\PasswordGenerator;
use RuntimeException;

class ValidateUserPasswordAction implements ValidateUserPasswordInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordGenerator $passwordGenerator
    ) {}

    public function validate(string $login, string $password): bool
    {
        $user = $this->userRepository->getByLogin($login);
        if (! $user) {
            throw new RuntimeException('User doesn\' exists');
        }

        $encryptedPassword = $this->passwordGenerator->generate($password);

        return password_verify($encryptedPassword->getPassword(), $user->getPasswordHash());
    }
}