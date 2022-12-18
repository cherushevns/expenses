<?php

namespace Core\Infrastructure\Password;

class PasswordGenerator
{
    public function generate(string $password): EncryptedPassword
    {
        $password = md5($password);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        return new EncryptedPassword(
            $password,
            $passwordHash
        );
    }
}