<?php

namespace App\RequestValidator\Income;

use Core\BusinessRules\Income\GetByIdInterface;

class DeleteValidator
{
    public function __construct(
        private GetByIdInterface $getById
    ) {}

    public function validate(int $id): array
    {
        $errors = [];

        if (! $this->getById->get($id)) {
            $errors[] = ['field' => 'id', 'error' => 'Доход не существует'];
        }

        return $errors;
    }
}