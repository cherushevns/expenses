<?php

namespace Core\Infrastructure\DataAccessors\Database\User;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;

class UserRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(UserEntity $user): int
    {
        $sql = <<<SQL
INSERT INTO user
SET
    name = :name,
    login = :login,
    email = :email,
    password = :password,
    password_hash = :passwordHash
SQL;

        $this->connection->query($sql, [
            'name' => $user->getName(),
            'login' => $user->getLogin(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'passwordHash' => $user->getPasswordHash(),
        ]);

        return $this->connection->getLastInsertId();
    }

    public function getById(int $id): ?UserEntity
    {
        $sql = <<<SQL
SELECT * FROM user WHERE id = :id
SQL;

        $result = $this->connection->fetchOne($sql, [
            'id' => $id
        ]);

        return $result ? $this->makeEntityFromRow($result) : null;
    }

    public function getByLogin(string $login): ?UserEntity
    {
        $sql = <<<SQL
SELECT * FROM user WHERE login = :login
SQL;

        $result = $this->connection->fetchOne($sql, [
            'login' => $login
        ]);

        return $result ? $this->makeEntityFromRow($result) : null;
    }

    private function makeEntityFromRow(array $row): UserEntity
    {
        return new UserEntity(
            $row['id'],
            $row['name'],
            $row['login'],
            $row['email'],
            $row['password'],
            $row['password_hash']
        );
    }
}