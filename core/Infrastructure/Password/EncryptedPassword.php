<?php

namespace Core\Infrastructure\Password;

class EncryptedPassword
{
    public function __construct(
        private string $password,
        private string $passwordHash
    ) {}

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}