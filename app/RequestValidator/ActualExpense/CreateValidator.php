<?php

namespace App\RequestValidator\ActualExpense;

use Core\BusinessRules\ExpenseCategory\GetByIdInterface;
use DateTimeImmutable;
use Throwable;

class CreateValidator
{
    public function __construct(
        private GetByIdInterface $getById
    ) {}

    public function validate(array $data): array
    {
        $errors = [];
        if (empty($data['categoryId'])) {
            $errors[] = ['field' => 'categoryId', 'error' => 'Заполните поле'];
        } else {
            if (! $this->getById->get($data['categoryId'])) {
                $errors[] = ['field' => 'categoryId', 'error' => 'Категория Вам не принадлежит @todo доделать'];
            }
        }

        if (empty($data['title'])) {
            $errors[] = ['field' => 'title', 'error' => 'Заполните поле'];
        }

        if (empty($data['amount'])) {
            $errors[] = ['field' => 'amount', 'error' => 'Заполните поле'];
        }

        if (empty($data['currency'])) {
            $errors[] = ['field' => 'currency', 'error' => 'Заполните поле'];
        }

        if (! empty($data['date'])) {
            try {
                $date = DateTimeImmutable::createFromFormat('Y-m-d', $data['date']);
            } catch (Throwable) {}

            if (! $date) {
                $errors[] = ['field' => 'date', 'error' => 'Дата должна быть следующего формата: ГГГГ-мм-дд'];
            }
        } else {
            $errors[] = ['field' => 'date', 'error' => 'Заполните поле'];
        }

        return $errors;
    }
}