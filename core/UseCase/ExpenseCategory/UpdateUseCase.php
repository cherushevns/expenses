<?php

namespace Core\UseCase\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\UpdateInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;

class UpdateUseCase
{
    public function __construct(
        private UpdateInterface $update
    ) {}

    public function update(ExpenseCategory $expenseCategory): void
    {
        $this->update->update($expenseCategory);
    }
}