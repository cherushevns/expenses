<?php

namespace Core\Interactors\RegularExpense;

use Core\BusinessRules\RegularExpense\GetRegularExpensesInterface;
use Core\BusinessRules\RegularExpense\RegularExpense;
use Core\Infrastructure\DataAccessors\Database\RegularExpense\RegularExpenseEntity;
use Core\Infrastructure\DataAccessors\Database\RegularExpense\RegularExpenseRepository;
use Core\Interactors\RegularExpense\Model\RegularExpenseModel;

class GetRegularExpensesAction implements GetRegularExpensesInterface
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

    public function get(int $userId): array
    {
        return array_map(
            fn (RegularExpenseEntity $regularExpenseEntity): RegularExpense => $this->regularExpenseModel->toBusiness(
                $regularExpenseEntity
            ),
            $this->regularExpenseRepository->getAllByUser($userId)
        );
    }
}