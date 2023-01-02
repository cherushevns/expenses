<?php

namespace Core\Interactors\PlannedExpense;

use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\BusinessRules\PlannedExpense\GetExistIdInterface;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;
use Core\Interactors\PlannedExpense\Model\PlannedExpenseModel;

class GetExistIdAction implements GetExistIdInterface
{
    private PlannedExpenseRepository $plannedExpenseRepository;
    private PlannedExpenseModel $plannedExpenseModel;

    public function __construct(
        PlannedExpenseRepository $plannedExpenseRepository,
        PlannedExpenseModel $plannedExpenseModel
    ) {
        $this->plannedExpenseRepository = $plannedExpenseRepository;
        $this->plannedExpenseModel = $plannedExpenseModel;
    }

    public function get(PlannedExpense $plannedExpense): ?int
    {
        return $this->plannedExpenseRepository->getId(
            $this->plannedExpenseModel->toData($plannedExpense)
        );
    }
}