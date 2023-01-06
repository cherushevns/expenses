<?php

namespace Core\Interactors\Auth\Model;

use Core\BusinessRules\Auth\Entity\UserCreateRequest;
use Core\Infrastructure\DataAccessors\Database\User\UserEntity;
use Core\Infrastructure\Password\EncryptedPassword;
use Core\Infrastructure\Password\PasswordGenerator;

class UserModel
{
    private PasswordGenerator $passwordGenerator;

    public function __construct(PasswordGenerator $passwordGenerator)
    {
        $this->passwordGenerator = $passwordGenerator;
    }

    public function toData(UserCreateRequest $userCreateRequest): UserEntity
    {
        $encryptedPassword = $this->encryptPassword($userCreateRequest->getPassword());

        return new UserEntity(
            null,
            $userCreateRequest->getName(),
            $userCreateRequest->getLogin(),
            $userCreateRequest->getEmail(),
            $encryptedPassword->getPasswordHash()
        );
    }

    private function encryptPassword(string $password): EncryptedPassword
    {
        return $this->passwordGenerator->generate($password);
    }
}