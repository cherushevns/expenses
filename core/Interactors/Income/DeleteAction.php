<?php

namespace Core\Interactors\Income;

use Core\BusinessRules\Income\DeleteInterface;
use Core\Infrastructure\DataAccessors\Database\Income\IncomeRepository;

class DeleteAction implements DeleteInterface
{
    public function __construct(
        private IncomeRepository $incomeRepository
    ) {}

    public function delete(int $id): void
    {
        $this->incomeRepository->deleteById($id);
    }
}