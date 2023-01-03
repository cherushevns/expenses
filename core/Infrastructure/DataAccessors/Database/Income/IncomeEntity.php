<?php

namespace Core\Infrastructure\DataAccessors\Database\Income;

use DateTimeImmutable;

class IncomeEntity
{
    public function __construct(
        private ?int $id,
        private string $title,
        private int $userId,
        private float $amount,
        private string $currency,
        private DateTimeImmutable $earnedAt
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

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