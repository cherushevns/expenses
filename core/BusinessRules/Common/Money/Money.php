<?php

namespace Core\BusinessRules\Common\Money;

use RuntimeException;

class Money
{
    public function __construct(
        private float $amount,
        private string $currency
    ) {}

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function add(self $money): self
    {
        if ($money->getCurrency() !== $this->getCurrency()) {
            throw new RuntimeException(
                'Wrong currencies (' . $money->getCurrency() . '->' . $this->getCurrency() . ')'
            );
        }

        return new self(
            bcadd($money->getAmount(), $this->amount, 2),
            $this->currency
        );
    }

    public function sub(self $money): self
    {
        if ($money->getCurrency() !== $this->getCurrency()) {
            throw new RuntimeException(
                'Wrong currencies (' . $money->getCurrency() . '->' . $this->getCurrency() . ')'
            );
        }

        return new self(
            bcsub($this->amount, $money->getAmount(), 2),
            $this->currency
        );
    }
}