<?php

namespace Core\BusinessRules\Report\Entity;

class ExpenseCategory
{
    /**
     * @param int $categoryId
     * @param ExpensePeriod[] $periods
     */
    public function __construct(
        private int $categoryId,
        private array $periods
    ) {}

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getPeriods(): array
    {
        return $this->periods;
    }
}