<?php

namespace Core\UseCase\ActualExpense;

use Core\BusinessRules\ActualExpense\DeleteInterface;

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