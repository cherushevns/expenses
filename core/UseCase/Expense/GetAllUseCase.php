<?php

namespace Core\UseCase\Expense;

use Core\BusinessRules\Expense\GetExpensesInterface;
use Core\BusinessRules\Expense\Entity\Expense;

class GetAllUseCase
{
    private GetExpensesInterface $getExpenses;

    public function __construct(GetExpensesInterface $getExpenses)
    {
        $this->getExpenses = $getExpenses;
    }

    /**
     * @param int $userId
     * @return Expense[]
     */
    public function get(int $userId): array
    {
        return $this->getExpenses->get($userId);
    }
}