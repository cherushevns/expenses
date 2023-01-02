<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\Expense;

interface GetAllInterface
{
    /**
     * @param int $userId
     * @return Expense[]
     */
    public function get(int $userId): array;
}