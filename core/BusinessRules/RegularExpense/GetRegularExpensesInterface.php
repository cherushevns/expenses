<?php

namespace Core\BusinessRules\RegularExpense;

interface GetRegularExpensesInterface
{
    /**
     * @param int $userId
     * @return RegularExpense[]
     */
    public function get(int $userId): array;
}