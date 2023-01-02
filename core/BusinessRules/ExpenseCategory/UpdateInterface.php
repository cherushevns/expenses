<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\Expense;

interface UpdateInterface
{
    public function update(Expense $expense): void;
}