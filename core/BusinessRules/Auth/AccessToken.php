<?php

namespace Core\BusinessRules\Auth;

use DateTimeImmutable;

class AccessToken
{
    public int $userId;
    public string $accessToken;
    public int $ttl;

    public function __construct(
        int $userId,
        string $accessToken,
        int $ttl
    ) {
        $this->userId = $userId;
        $this->accessToken = $accessToken;
        $this->ttl = $ttl;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }
}