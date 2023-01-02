<?php

namespace App\RequestValidator\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\CheckIsExistsInterface;
use Core\BusinessRules\ExpenseCategory\Entity\Expense;
use Core\BusinessRules\ExpenseCategory\Entity\Type;

class CreateValidator
{
    private CheckIsExistsInterface $checkIsExists;

    public function __construct(
        CheckIsExistsInterface $checkIsExists
    ) {
        $this->checkIsExists = $checkIsExists;
    }

    public function validate(array $data): array
    {
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = ['field' => 'title', 'error' => 'Заполните поле'];
        }

        if (empty($data['type'])) {
            $errors[] = ['field' => 'type', 'error' => 'Заполните поле'];
        }

        if (! empty($errors)) {
            return $errors;
        }

        $expense = new Expense(
            null,
            null,
            $data['title'],
            new Type($data['type'])
        );

        if ($this->checkIsExists->check($expense)) {
            $errors[] = ['field' => 'title', 'error' => 'В данной категории запись с таким названием уже существует'];
        }

        return $errors;
    }
}