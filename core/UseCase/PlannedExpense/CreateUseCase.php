<?php

namespace Core\UseCase\PlannedExpense;

use Core\BusinessRules\PlannedExpense\CreateInterface;
use Core\BusinessRules\PlannedExpense\DeleteByIdInterface;
use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\BusinessRules\PlannedExpense\GetExistIdInterface;

class CreateUseCase
{
    private GetExistIdInterface $getExistId;
    private DeleteByIdInterface $deleteById;
    private CreateInterface $create;

    public function __construct(
        GetExistIdInterface $getExistId,
        DeleteByIdInterface $deleteById,
        CreateInterface $create
    ) {
        $this->getExistId = $getExistId;
        $this->deleteById = $deleteById;
        $this->create = $create;
    }

    public function create(PlannedExpense $plannedExpense): void
    {
        $existsId = $this->getExistId->get($plannedExpense);
        if ($existsId) {
            $this->deleteById->delete($existsId);
        }

        $this->create->create($plannedExpense);
    }
}