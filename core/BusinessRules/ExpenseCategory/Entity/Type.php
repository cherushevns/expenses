<?php

namespace Core\BusinessRules\ExpenseCategory\Entity;

use RuntimeException;

class Type
{
    public function __construct(private int $type)
    {
        if (! in_array($type, TypeEnum::ALL)) {
            throw new RuntimeException('Unknown type ' . $type);
        }
    }

    public function getType(): int
    {
        return $this->type;
    }
}