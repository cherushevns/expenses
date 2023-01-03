<?php

namespace Core\BusinessRules\Report\Entity;

class Expenses
{
    /**
     * @param ExpenseCategory[] $categories
     */
    public function __construct(
        private array $categories
    ) {}

    public function getCategories(): array
    {
        return $this->categories;
    }
}