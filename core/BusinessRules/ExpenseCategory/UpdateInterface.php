<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;

interface UpdateInterface
{
    public function update(ExpenseCategory $expenseCategory): void;
}