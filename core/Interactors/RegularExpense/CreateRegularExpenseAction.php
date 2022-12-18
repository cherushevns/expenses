<?php

namespace Core\Interactors\RegularExpense;

use Core\BusinessRules\RegularExpense\CreateRegularExpenseInterface;
use Core\BusinessRules\RegularExpense\RegularExpense;
use Core\Infrastructure\DataAccessors\Database\RegularExpense\RegularExpenseRepository;
use Core\Interactors\RegularExpense\Model\RegularExpenseModel;

class CreateRegularExpenseAction implements CreateRegularExpenseInterface
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

    public function create(RegularExpense $regularExpense): int
    {
        return $this->regularExpenseRepository->create(
            $this->regularExpenseModel->toData($regularExpense)
        );
    }
}