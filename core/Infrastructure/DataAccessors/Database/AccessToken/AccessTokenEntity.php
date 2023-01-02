<?php

namespace Core\Infrastructure\DataAccessors\Database\AccessToken;

use DateTimeImmutable;

class AccessTokenEntity
{
    public function __construct(
        private int $userId,
        private string $accessToken,
        private DateTimeImmutable $expiresAt
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getExpiresAt(): DateTimeImmutable
    {
        return $this->expiresAt;
    }
}