<?php

namespace Core\Infrastructure\DataAccessors\Database\PlannedExpense;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;

use DateTimeInterface;
use DateTimeImmutable;

class PlannedExpenseRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(PlannedExpenseEntity $plannedExpense): void
    {
        $sql = <<<SQL
INSERT INTO planned_expense
SET
    category_id = :categoryId,
    amount = :amount,
    currency = :currency,
    will_be_spent_at = :willBeSpentAt
SQL;

        $this->connection->query($sql, [
            'categoryId' => $plannedExpense->getCategoryId(),
            'amount' => $plannedExpense->getAmount(),
            'currency' => $plannedExpense->getCurrency(),
            'willBeSpentAt' => $plannedExpense->getWillBeSpentAt()?->format(DateTimeInterface::ATOM)
        ]);
    }

    public function getId(PlannedExpenseEntity $plannedExpense): ?int
    {
        $parameters = [];
        $addWhere = '';
        if (! $plannedExpense->getWillBeSpentAt()) {
            $addWhere .= ' AND will_be_spent_at IS NULL';
        } else {
            $addWhere .= ' AND will_be_spent_at = :willBeSpentAt';
            $parameters['willBeSpentAt'] = $plannedExpense->getWillBeSpentAt()->format(DateTimeInterface::ATOM);
        }

        $sql = <<<SQL
SELECT id FROM planned_expense
WHERE
    category_id = :categoryId $addWhere
SQL;
        $parameters['categoryId'] = $plannedExpense->getCategoryId();

        $row = $this->connection->fetchOne($sql, $parameters);

        return $row ? $row['id'] : null;
    }

    public function deleteById(int $id): void
    {
        $sql = <<<SQL
DELETE FROM planned_expense
WHERE
    id = :id
SQL;

        $this->connection->query($sql, ['id' => $id]);
    }
}