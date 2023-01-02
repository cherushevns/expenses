<?php

namespace Core\Interactors\ActualExpense;

use Core\BusinessRules\ActualExpense\Entity\ActualExpense;
use Core\BusinessRules\ActualExpense\GetByIdInterface;
use Core\Infrastructure\DataAccessors\Database\ActualExpense\ActualExpenseRepository;
use Core\Interactors\ActualExpense\Model\ActualExpenseModel;

class GetByIdAction implements GetByIdInterface
{
    public function __construct(
        private ActualExpenseRepository $actualExpenseRepository,
        private ActualExpenseModel $actualExpenseModel,
    ) {}

    public function get(int $id): ?ActualExpense
    {
        $actualExpenseEntity = $this->actualExpenseRepository->getById($id);

        return $actualExpenseEntity ? $this->actualExpenseModel->toBusiness($actualExpenseEntity) : null;
    }
}