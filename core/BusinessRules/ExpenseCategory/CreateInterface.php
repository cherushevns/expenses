<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\Expense;

interface CreateInterface
{
    public function create(Expense $expense): int;
}