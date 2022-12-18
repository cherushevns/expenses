<?php

namespace App\RequestValidator\ExpenseEntry;

class CreateValidator
{
    public function validate(array $data): array
    {
        $errors = [];
        if (empty($data['amount'])) {
            $errors[] = ['field' => 'amount', 'error' => 'Заполните поле'];
        }
        if (empty($data['from'])) {
            $errors[] = ['field' => 'from', 'error' => 'Заполните поле'];
        }
        if (empty($data['to'])) {
            $errors[] = ['field' => 'to', 'error' => 'Заполните поле'];
        }

        return $errors;
    }
}