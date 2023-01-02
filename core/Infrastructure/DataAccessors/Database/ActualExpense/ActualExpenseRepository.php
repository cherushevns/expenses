<?php

namespace Core\Infrastructure\DataAccessors\Database\ActualExpense;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;
use DateTimeImmutable;
use DateTimeInterface;

class ActualExpenseRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(ActualExpenseEntity $actualExpense): void
    {
        $sql = <<<SQL
INSERT INTO actual_expense
SET
    category_id = :categoryId,
    amount = :amount,
    currency = :currency,
    title = :title,
    spent_at = :spentAt
SQL;

        $this->connection->query($sql, [
            'categoryId' => $actualExpense->getCategoryId(),
            'amount' => $actualExpense->getAmount(),
            'currency' => $actualExpense->getCurrency(),
            'title' => $actualExpense->getTitle(),
            'spentAt' => $actualExpense->getSpentAt()->format(DateTimeInterface::ATOM)
        ]);
    }

    public function delete(int $id): void
    {
        $sql = <<<SQL
DELETE FROM acutal_expense
WHERE
    id = :id
SQL;
        $this->connection->query($sql, ['id' => $id]);
    }

    public function getById(int $id): ?ActualExpenseEntity
    {
        $sql = <<<SQL
SELECT * FROM actual_expense
WHERE
    id = :id
SQL;

        $row = $this->connection->fetchOne($sql, ['id' => $id]);

        return $row ? $this->makeEntityFromRow($row) : null;
    }

    private function makeEntityFromRow(array $row): ActualExpenseEntity
    {
        return new ActualExpenseEntity(
            $row['category_id'],
            $row['title'],
            $row['amount'],
            $row['currency'],
            new DateTimeImmutable($row['spent_at'])
        );
    }

}