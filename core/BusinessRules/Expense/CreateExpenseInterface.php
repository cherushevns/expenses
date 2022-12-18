<?php

namespace Core\BusinessRules\Expense;

use Core\BusinessRules\Expense\Entity\Expense;

interface CreateExpenseInterface
{
    public function create(Expense $expense): int;
}