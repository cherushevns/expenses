<?php

namespace Core\BusinessRules\Expense;

use Core\BusinessRules\Expense\Entity\Expense;

interface UpdateExpenseInterface
{
    public function update(Expense $expense): void;
}