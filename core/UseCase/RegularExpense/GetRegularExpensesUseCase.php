<?php

namespace Core\UseCase\RegularExpense;

use Core\BusinessRules\RegularExpense\GetRegularExpensesInterface;
use Core\BusinessRules\RegularExpense\RegularExpense;

class GetRegularExpensesUseCase
{
    private GetRegularExpensesInterface $getRegularExpenses;

    public function __construct(GetRegularExpensesInterface $getRegularExpenses)
    {
        $this->getRegularExpenses = $getRegularExpenses;
    }

    /**
     * @param int $userId
     * @return RegularExpense[]
     */
    public function get(int $userId): array
    {
        return $this->getRegularExpenses->get($userId);
    }
}