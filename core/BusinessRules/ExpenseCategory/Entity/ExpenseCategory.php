<?php

namespace Core\BusinessRules\ExpenseCategory\Entity;

class ExpenseCategory
{
    public function __construct(
        private ?int $id,
        private ?int $userId,
        private string $title,
        private Type $type
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getType(): int
    {
        return $this->type->getType();
    }
}