<?php

namespace Core\UseCase\PlannedExpense;

use Core\BusinessRules\PlannedExpense\CreateInterface;
use Core\BusinessRules\PlannedExpense\DeleteByIdInterface;
use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\BusinessRules\PlannedExpense\GetExistIdInterface;

class CreateUseCase
{
    public function __construct(
        private GetExistIdInterface $getExistId,
        private DeleteByIdInterface $deleteById,
        private CreateInterface $create
    ) {}

    public function create(PlannedExpense $plannedExpense): void
    {
        $existsId = $this->getExistId->get($plannedExpense);
        if ($existsId) {
            $this->deleteById->delete($existsId);
        }

        $this->create->create($plannedExpense);
    }
}