<?php

namespace Core\BusinessRules\ExpenseCategory\Entity;

use RuntimeException;

class Type
{
    private int $type;

    public function __construct(int $type)
    {
        if (! in_array($type, TypeEnum::ALL)) {
            throw new RuntimeException('Unknown type ' . $type);
        }

        $this->type = $type;
    }

    public function getType(): int
    {
        return $this->type;
    }
}