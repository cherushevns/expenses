<?php

namespace App\RequestValidator\Income;

use DateTimeImmutable;
use Throwable;

class CreateValidator
{
    public function validate(array $data): array
    {
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