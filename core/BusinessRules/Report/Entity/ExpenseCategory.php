<?php

namespace Core\BusinessRules\Report\Entity;

class ExpenseCategory
{
    /**
     * @param int $categoryId
     * @param int $type
     * @param ExpensePeriod[] $periods
     */
    public function __construct(
        private int $categoryId,
        private int $type,
        private array $periods
    ) {}

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getPeriods(): array
    {
        return $this->periods;
    }
}