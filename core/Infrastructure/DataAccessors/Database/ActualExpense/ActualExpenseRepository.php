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
DELETE FROM actual_expense
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

    /**
     * @param int[] $categoriesIds
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @return ActualExpenseEntity[]
     */
    public function getByCategoriesIdsAndDates(
        array $categoriesIds,
        DateTimeImmutable $dateFrom,
        DateTimeImmutable $dateTo
    ): array {
        $sql = <<<SQL
SELECT * FROM actual_expense
WHERE
    category_id IN (:categoriesIds) AND
    spent_at BETWEEN :dateFrom AND :dateTo
SQL;

        $rows = $this->connection->fetchAll($sql, [
            'categoriesIds' => $categoriesIds,
            'dateFrom' => $dateFrom->format(DateTimeInterface::ATOM),
            'dateTo' => $dateTo->format(DateTimeInterface::ATOM)
        ], [
            'categoriesIds' => ConnectionInterface::TYPE_INTEGER_ARRAY
        ]);

        return $rows ? $this->makeEntitiesFromRows($rows): [];
    }

    public function deleteByCategoryId(int $categoryId): void
    {
        $sql = <<<SQL
DELETE FROM actual_expense
WHERE
    category_id = :categoryId
SQL;

        $this->connection->query($sql, ['categoryId' => $categoryId]);
    }

    /**
     * @param array $rows
     * @return ActualExpenseEntity[]
     */
    private function makeEntitiesFromRows(array $rows): array
    {
        return array_map(
            fn (array $row): ActualExpenseEntity => $this->makeEntityFromRow($row),
            $rows
        );
    }

    private function makeEntityFromRow(array $row): ActualExpenseEntity
    {
        return new ActualExpenseEntity(
            $row['id'],
            $row['category_id'],
            $row['title'],
            $row['amount'],
            $row['currency'],
            new DateTimeImmutable($row['spent_at'])
        );
    }

}