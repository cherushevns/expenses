<?php

namespace App\RequestValidator\Report;

use DateTimeImmutable;
use Throwable;

class GetValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['from'])) {
            $errors[] = ['field' => 'from', 'error' => 'Заполните поле'];
        } else {
            try {
                $date = DateTimeImmutable::createFromFormat('m.Y', $data['from']);
            } catch (Throwable) {}

            if (! $date) {
                $errors[] = ['field' => 'from', 'error' => 'Дата должна быть следующего формата: ГГГГ-мм'];
            }
        }

        if (empty($data['to'])) {
            $errors[] = ['field' => 'to', 'error' => 'Заполните поле'];
        } else {
            try {
                $date = DateTimeImmutable::createFromFormat('m.Y', $data['from']);
            } catch (Throwable) {}

            if (! $date) {
                $errors[] = ['field' => 'to', 'error' => 'Дата должна быть следующего формата: ГГГГ-мм'];
            }
        }

        return $errors;
    }
}