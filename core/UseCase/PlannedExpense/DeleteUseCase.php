<?php

namespace Core\UseCase\PlannedExpense;

use Core\BusinessRules\PlannedExpense\DeleteInterface;

class DeleteUseCase
{
    public function __construct(
        private DeleteInterface $delete
    ) {}

    public function delete(int $id): void
    {
        $this->delete->delete($id);
    }
}