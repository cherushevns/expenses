<?php

namespace Core\Infrastructure\DataAccessors\Database\User;

class UserEntity
{
    private ?int $id;
    private string $name;
    private string $login;
    private string $email;
    private string $password;
    private string $passwordHash;

    public function __construct(
        ?int $id,
        string $name,
        string $login,
        string $email,
        string $password,
        string $passwordHash
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->passwordHash = $passwordHash;
    }

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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}