<?php

namespace Core\BusinessRules\Auth\Entity;

class AccessToken
{
    public function __construct(
        private int $userId,
        private string $accessToken,
        private int $ttl
    ) {}

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