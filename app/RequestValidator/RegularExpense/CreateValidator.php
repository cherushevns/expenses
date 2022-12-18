<?php

namespace App\RequestValidator\RegularExpense;

use Core\BusinessRules\RegularExpense\CheckIsUserRegularExpenseExistsByTitleInterface;

class CreateValidator
{
    private CheckIsUserRegularExpenseExistsByTitleInterface $checkIsUserRegularExpenseExistsByTitle;

    public function __construct(
        CheckIsUserRegularExpenseExistsByTitleInterface $checkIsUserRegularExpenseExistsByTitle,
    ) {
        $this->checkIsUserRegularExpenseExistsByTitle = $checkIsUserRegularExpenseExistsByTitle;
    }

    public function validate(array $data, int $userId): array
    {
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = ['field' => 'title', 'error' => 'Заполните поле'];
        }

        if (! empty($errors)) {
            return $errors;
        }

        if ($this->checkIsUserRegularExpenseExistsByTitle->check($data['title'], $userId)) {
            $errors[] = ['field' => 'title', 'error' => 'Запись с таким названием уже существует'];
        }

        return $errors;
    }
}