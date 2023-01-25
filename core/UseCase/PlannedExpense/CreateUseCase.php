<?php

namespace Core\UseCase\PlannedExpense;

use Core\BusinessRules\PlannedExpense\CreateInterface;
use Core\BusinessRules\PlannedExpense\DeleteInterface;
use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\BusinessRules\PlannedExpense\GetExistIdInterface;

readonly class CreateUseCase
{
    public function __construct(
        private GetExistIdInterface $getExistId,
        private DeleteInterface $deleteById,
        private CreateInterface $create
    ) {}

    public function create(PlannedExpense $plannedExpense): void
    {
        // Удаляем планируемый расход на весь месяц, если прислали расход на тот же месяц
        if (! $plannedExpense->getWillBeSpentAt()) {
            $existsId = $this->getExistId->get($plannedExpense);
            if ($existsId) {
                $this->deleteById->delete($existsId);
            }
        }

        $this->create->create($plannedExpense);
    }
}