<?php

namespace Core\BusinessRules\Expense\Entity;

use RuntimeException;

class Type
{
    private int $type;

    public function __construct(int $type)
    {
        if (! in_array($this, TypeEnum::ALL)) {
            throw new RuntimeException('Unknown type ' . $type);
        }

        $this->type = $type;
    }

    public function getType(): int
    {
        return $this->type;
    }
}