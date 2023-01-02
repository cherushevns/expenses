<?php

namespace Core\BusinessRules\ActualExpense\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class ActualExpense
{
    public function __construct(
        private int $categoryId,
        private string $title,
        private Money $money,
        private DateTimeImmutable $spentAt
    ) {}

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getSpentAt(): DateTimeImmutable
    {
        return $this->spentAt;
    }
}