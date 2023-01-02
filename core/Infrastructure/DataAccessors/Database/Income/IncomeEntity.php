<?php

namespace Core\Infrastructure\DataAccessors\Database\Income;

use DateTimeImmutable;

class IncomeEntity
{
    public function __construct(
        private int $userId,
        private float $amount,
        private string $currency,
        private DateTimeImmutable $earnedAt
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getEarnedAt(): DateTimeImmutable
    {
        return $this->earnedAt;
    }
}