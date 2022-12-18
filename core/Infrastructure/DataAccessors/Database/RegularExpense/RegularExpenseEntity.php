<?php

namespace Core\Infrastructure\DataAccessors\Database\RegularExpense;

class RegularExpenseEntity
{
    private ?int $id;
    private string $title;
    private int $userId;

    public function __construct(
        ?int $id,
        string $title,
        int $userId
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->userId = $userId;
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
}