<?php

namespace App\RequestValidator\Expense;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\Expense\CheckIsExpenseExistsInterface;
use Core\BusinessRules\Expense\Entity\Expense;
use Core\BusinessRules\Expense\Entity\Type;

class CreateValidator
{
    private CheckIsExpenseExistsInterface $checkIsExpenseExists;

    public function __construct(
        CheckIsExpenseExistsInterface $checkIsExpenseExists
    ) {
        $this->checkIsExpenseExists = $checkIsExpenseExists;
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

        if ($this->checkIsExpenseExists->check($expense)) {
            $errors[] = ['field' => 'title', 'error' => 'В данной категории запись с таким названием уже существует'];
        }

        return $errors;
    }
}