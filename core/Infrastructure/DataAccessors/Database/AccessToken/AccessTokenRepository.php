<?php

namespace Core\Infrastructure\DataAccessors\Database\AccessToken;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;
use DateTimeImmutable;

class AccessTokenRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function save(AccessTokenEntity $accessToken): void
    {
        $sql = <<<SQL
INSERT INTO access_token
SET
    user_id = :userId,
    access_token = :accessToken,
    expires_at = :expiresAt
SQL;

        $this->connection->query($sql, [
            'userId' => $accessToken->getUserId(),
            'accessToken' => $accessToken->getAccessToken(),
            'expiresAt' => $accessToken->getExpiresAt()->format(DateTimeImmutable::ATOM)
        ]);
    }

    public function clearUserTokens(int $userId): void
    {
        $sql = <<<SQL
DELETE FROM access_token WHERE user_id = :userId
SQL;

        $this->connection->query($sql, [
            'userId' => $userId
        ]);
    }

    public function getByToken(string $token): ?AccessTokenEntity
    {
        $sql = <<<SQL
SELECT * FROM access_token WHERE access_token = :token
SQL;

        $result = $this->connection->fetchOne($sql, [
            'token' => $token
        ]);

        return $result ? $this->makeEntityFromRow($result) : null;
    }

    private function makeEntityFromRow(array $row): AccessTokenEntity
    {
        return new AccessTokenEntity(
            $row['user_id'],
            $row['access_token'],
            new DateTimeImmutable($row['expires_at'])
        );
    }
}