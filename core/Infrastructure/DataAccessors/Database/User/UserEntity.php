<?php

namespace Core\Infrastructure\DataAccessors\Database\User;

class UserEntity
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $login,
        private string $email,
        private string $passwordHash
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}