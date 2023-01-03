<?php

namespace Core\BusinessRules\Report\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class IncomeEntry
{
    public function __construct(
        private int $id,
        private string $title,
        private Money $money,
        private DateTimeImmutable $earnedAt
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getEarnedAt(): DateTimeImmutable
    {
        return $this->earnedAt;
    }
}