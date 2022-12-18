<?php

namespace Core\UseCase\RegularExpense;

use Core\BusinessRules\RegularExpense\UpdateRegularExpenseInterface;
use Core\BusinessRules\RegularExpense\RegularExpense;

class UpdateRegularExpenseUseCase
{
    private UpdateRegularExpenseInterface $updateRegularExpense;

    public function __construct(
        UpdateRegularExpenseInterface $updateRegularExpense
    ) {
        $this->updateRegularExpense = $updateRegularExpense;
    }

    public function update(RegularExpense $regularExpense): void
    {
        $this->updateRegularExpense->update($regularExpense);
    }
}