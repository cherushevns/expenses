<?php

namespace App\RequestValidator\Expense;

use Core\BusinessRules\Expense\CheckIsExpenseExistsInterface;
use Core\BusinessRules\Expense\Entity\Expense;
use Core\BusinessRules\Expense\Entity\Type;

class UpdateValidator
{
    private CheckIsExpenseExistsInterface $checkIsExpenseExists;

    public function __construct(
        CheckIsExpenseExistsInterface $checkIsExpenseExists
    ) {
        $this->checkIsExpenseExists = $checkIsExpenseExists;
    }

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

        $expense = new Expense(
            $id,
            null,
            $data['title'],
            new Type($data['type'])
        );

        if ($this->checkIsExpenseExists->check($expense)) {
            $errors[] = ['field' => 'title', 'error' => 'В данной категории запись с таким названием уже существует'];
        }

        return $errors;
    }
}