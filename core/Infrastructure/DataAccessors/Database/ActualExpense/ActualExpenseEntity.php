<?php

namespace Core\Infrastructure\DataAccessors\Database\ActualExpense;

use DateTimeImmutable;

class ActualExpenseEntity
{
    public function __construct(
        private ?int $id,
        private int $categoryId,
        private string $title,
        private float $amount,
        private string $currency,
        private DateTimeImmutable $spentAt,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getSpentAt(): DateTimeImmutable
    {
        return $this->spentAt;
    }
}