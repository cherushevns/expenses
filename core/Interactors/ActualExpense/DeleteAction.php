<?php

namespace Core\Interactors\ActualExpense;

use Core\BusinessRules\ActualExpense\DeleteInterface;
use Core\Infrastructure\DataAccessors\Database\ActualExpense\ActualExpenseRepository;

class DeleteAction implements DeleteInterface
{
    public function __construct(
        private ActualExpenseRepository $actualExpenseRepository,
    ) {}

    public function delete(int $id): void
    {
        $this->actualExpenseRepository->delete($id);
    }
}