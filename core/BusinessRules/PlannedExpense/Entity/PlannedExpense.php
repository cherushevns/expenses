<?php

namespace Core\BusinessRules\PlannedExpense\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

/**
 * @description Регулярный планируемый расход по категории
 * Привязывается к категории, к году и к месяцу
 */
class PlannedExpense
{
    public function __construct(
        private string $title,
        private int $categoryId,
        private Money $money,
        private ?DateTimeImmutable $willBeSpentAt
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getWillBeSpentAt(): ?DateTimeImmutable
    {
        return $this->willBeSpentAt;
    }
}