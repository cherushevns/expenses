<?php

namespace Core\Interactors\PlannedExpense;

use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\BusinessRules\PlannedExpense\GetExistIdInterface;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;
use Core\Interactors\PlannedExpense\Model\PlannedExpenseModel;

class GetExistIdAction implements GetExistIdInterface
{
    public function __construct(
        private PlannedExpenseRepository $plannedExpenseRepository,
        private PlannedExpenseModel $plannedExpenseModel
    ) {}

    public function get(PlannedExpense $plannedExpense): ?int
    {
        return $this->plannedExpenseRepository->getId(
            $this->plannedExpenseModel->toData($plannedExpense)
        );
    }
}