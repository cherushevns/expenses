<?php

namespace Core\BusinessRules\Expense;

use Core\BusinessRules\Expense\Entity\Expense;

interface GetExpensesInterface
{
    /**
     * @param int $userId
     * @return Expense[]
     */
    public function get(int $userId): array;
}