<?php

namespace Core\Infrastructure\DataAccessors\Database\AccessToken;

use DateTimeImmutable;

class AccessTokenEntity
{
    private int $userId;
    private string $accessToken;
    private DateTimeImmutable $expiresAt;

    public function __construct(
        int $userId,
        string $accessToken,
        DateTimeImmutable $expiresAt
    ) {
        $this->userId = $userId;
        $this->accessToken = $accessToken;
        $this->expiresAt = $expiresAt;
    }

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