<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;

interface CheckIsExistsInterface
{
    public function check(ExpenseCategory $expenseCategory): bool;
}