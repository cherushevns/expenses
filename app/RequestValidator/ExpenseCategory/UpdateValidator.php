<?php

namespace App\RequestValidator\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\CheckIsExistsInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\BusinessRules\ExpenseCategory\Entity\Type;

class UpdateValidator
{
    public function __construct(
        private CheckIsExistsInterface $checkIsExists
    ) {}

    public function validate(array $data, int $id): array
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

        $expense = new ExpenseCategory(
            $id,
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