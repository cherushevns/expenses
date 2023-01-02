<?php

namespace Core\BusinessRules\Income\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class Income
{
    public function __construct(
        private Money $money,
        private DateTimeImmutable $earnedAt,
        private ?int $userId = null
    ) {}

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getEarnedAt(): DateTimeImmutable
    {
        return $this->earnedAt;
    }

    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}