<?php

namespace Core\BusinessRules\Expense\Entity;

class Expense
{
    private ?int $id;
    private ?int $userId;
    private string $title;
    private Type $type;

    public function __construct(
        ?int $id,
        ?int $userId,
        string $title,
        Type $type
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->type = $type;
    }

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