<?php

namespace Core\BusinessRules\Auth\Entity;

class UserCreateRequest
{
    public function __construct(
        private string $name,
        private string $login,
        private string $email,
        private string $password
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}