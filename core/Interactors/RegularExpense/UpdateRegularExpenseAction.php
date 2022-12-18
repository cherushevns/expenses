<?php

namespace Core\Interactors\RegularExpense;

use Core\BusinessRules\RegularExpense\RegularExpense;
use Core\BusinessRules\RegularExpense\UpdateRegularExpenseInterface;
use Core\Infrastructure\DataAccessors\Database\RegularExpense\RegularExpenseRepository;
use Core\Interactors\RegularExpense\Model\RegularExpenseModel;

class UpdateRegularExpenseAction implements UpdateRegularExpenseInterface
{
    private RegularExpenseRepository $regularExpenseRepository;
    private RegularExpenseModel $regularExpenseModel;

    public function __construct(
        RegularExpenseRepository $regularExpenseRepository,
        RegularExpenseModel $regularExpenseModel
    ) {
        $this->regularExpenseRepository = $regularExpenseRepository;
        $this->regularExpenseModel = $regularExpenseModel;
    }

    public function update(RegularExpense $regularExpense): void
    {
        $this->regularExpenseRepository->update(
            $this->regularExpenseModel->toData($regularExpense)
        );
    }
}