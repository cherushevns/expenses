<?php

namespace Core\Interactors\PlannedExpense;

use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\BusinessRules\PlannedExpense\GetByIdInterface;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;
use Core\Interactors\PlannedExpense\Model\PlannedExpenseModel;

class GetByIdAction implements GetByIdInterface
{
    public function __construct(
        private PlannedExpenseRepository $plannedExpenseRepository,
        private PlannedExpenseModel $plannedExpenseModel,
    ) {}

    public function get(int $id): ?PlannedExpense
    {
        $plannedExpenseEntity = $this->plannedExpenseRepository->getById($id);

        return $plannedExpenseEntity ? $this->plannedExpenseModel->toBusiness($plannedExpenseEntity) : null;
    }
}