<?php

namespace Core\UseCase\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory;

class DeleteUseCase
{
    public function __construct(
        private ExpenseCategory\DeleteInterface $expenseCategoryDelete
    ) {}

    public function delete(int $id): void
    {
        $this->expenseCategoryDelete->delete($id);
    }
}