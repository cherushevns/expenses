<?php

namespace Core\UseCase\RegularExpense;

use Core\BusinessRules\RegularExpense\CreateRegularExpenseInterface;
use Core\BusinessRules\RegularExpense\RegularExpense;

class CreateRegularExpenseUseCase
{
    private CreateRegularExpenseInterface $createRegularExpense;

    public function __construct(
        CreateRegularExpenseInterface $createRegularExpense
    ) {
        $this->createRegularExpense = $createRegularExpense;
    }

    public function create(RegularExpense $regularExpense): int
    {
        return $this->createRegularExpense->create($regularExpense);
    }
}