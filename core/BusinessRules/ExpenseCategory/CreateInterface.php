<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;

interface CreateInterface
{
    public function create(ExpenseCategory $expenseCategory): int;
}