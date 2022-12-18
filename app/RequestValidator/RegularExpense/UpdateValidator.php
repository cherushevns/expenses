<?php

namespace App\RequestValidator\RegularExpense;

use Core\BusinessRules\RegularExpense\CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface;

class UpdateValidator
{
    private CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface $checkIsUserRegularExpenseExistsByTitleExcludeId;

    public function __construct(
        CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface $checkIsUserRegularExpenseExistsByTitleExcludeId
    ) {
        $this->checkIsUserRegularExpenseExistsByTitleExcludeId = $checkIsUserRegularExpenseExistsByTitleExcludeId;
    }

    public function validate(array $data, int $id, int $userId): array
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors[] = ['field' => 'title', 'error' => 'Заполните поле'];
        }

        if (! empty($errors)) {
            return $errors;
        }

        if ($this->checkIsUserRegularExpenseExistsByTitleExcludeId->check($data['title'], $id, $userId)) {
            $errors[] = ['field' => 'title', 'error' => 'Запись с таким названием уже существует'];
        }

        return $errors;
    }
}