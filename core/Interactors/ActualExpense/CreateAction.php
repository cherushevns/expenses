<?php

namespace Core\Interactors\ActualExpense;

use Core\BusinessRules\ActualExpense\CreateInterface;
use Core\BusinessRules\ActualExpense\Entity\ActualExpense;
use Core\Infrastructure\DataAccessors\Database\ActualExpense\ActualExpenseRepository;
use Core\Interactors\ActualExpense\Model\ActualExpenseModel;

class CreateAction implements CreateInterface
{
    public function __construct(
        private ActualExpenseRepository $actualExpenseRepository,
        private ActualExpenseModel $actualExpenseModel,
    ) {}

    public function create(ActualExpense $actualExpense): void
    {
        $this->actualExpenseRepository->create(
            $this->actualExpenseModel->toData($actualExpense)
        );
    }
}