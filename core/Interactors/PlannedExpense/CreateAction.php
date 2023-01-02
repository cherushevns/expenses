<?php

namespace Core\Interactors\PlannedExpense;

use Core\BusinessRules\PlannedExpense\CreateInterface;
use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;
use Core\Interactors\PlannedExpense\Model\PlannedExpenseModel;

class CreateAction implements CreateInterface
{
    public function __construct(
        private PlannedExpenseRepository $plannedExpenseRepository,
        private PlannedExpenseModel $plannedExpenseModel
    ) {}

    public function create(PlannedExpense $plannedExpense): void
    {
        $this->plannedExpenseRepository->create(
            $this->plannedExpenseModel->toData($plannedExpense)
        );
    }
}