<?php

namespace Core\Infrastructure\DataAccessors\Database\ExpenseCategory;

class ExpenseCategoryEntity
{
    private ?int $id;
    private string $title;
    private int $userId;
    private int $type;

    public function __construct(
        ?int $id,
        string $title,
        int $userId,
        int $type
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->userId = $userId;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getType(): int
    {
        return $this->type;
    }
}