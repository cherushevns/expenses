<?php

namespace App\RequestValidator\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\GetByIdInterface;

class DeleteValidator
{
    public function __construct(
        private GetByIdInterface $getById
    ) {}

    public function validate(int $id): array
    {
        $errors = [];

        if (! $this->getById->get($id)) {
            $errors[] = ['field' => 'title', 'error' => 'Категория Вам не принадлежит'];
        }

        return $errors;
    }
}