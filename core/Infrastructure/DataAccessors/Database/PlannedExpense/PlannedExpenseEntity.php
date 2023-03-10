<?php

namespace Core\Infrastructure\DataAccessors\Database\PlannedExpense;

use DateTimeImmutable;

class PlannedExpenseEntity
{
    public function __construct(
        private ?int $id,
        private string $title,
        private int $categoryId,
        private float $amount,
        private string $currency,
        private ?DateTimeImmutable $willBeSpentAt
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getWillBeSpentAt(): ?DateTimeImmutable
    {
        return $this->willBeSpentAt;
    }
}