<?php

namespace Core\BusinessRules\Expense;

use Core\BusinessRules\Expense\Entity\Expense;

interface CheckIsExpenseExistsInterface
{
    public function check(Expense $expense): bool;
}