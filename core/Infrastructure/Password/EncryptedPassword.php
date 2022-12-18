<?php

namespace Core\Infrastructure\Password;

class EncryptedPassword
{
    private string $password;
    private string $passwordHash;

    public function __construct(
        string $password,
        string $passwordHash
    ) {
        $this->password = $password;
        $this->passwordHash = $passwordHash;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}