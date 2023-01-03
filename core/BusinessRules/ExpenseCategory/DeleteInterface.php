<?php

namespace Core\BusinessRules\ExpenseCategory;

interface DeleteInterface
{
    public function delete(int $id): void;
}