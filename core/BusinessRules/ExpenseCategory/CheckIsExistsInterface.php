<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\Expense;

interface CheckIsExistsInterface
{
    public function check(Expense $expense): bool;
}