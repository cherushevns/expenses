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

    /**
     * @param int[] $categoriesIds
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @return PlannedExpenseEntity[]
     */
    public function getByCategoriesIdsAndDates(
        array $categoriesIds,
        DateTimeImmutable $dateFrom,
        DateTimeImmutable $dateTo
    ): array {
        $sql = <<<SQL
SELECT * FROM planned_expense
WHERE
    category_id IN (:categoriesIds) AND
    (will_be_spent_at BETWEEN :dateFrom AND :dateTo OR will_be_spent_at IS NULL)
SQL;

        $rows = $this->connection->fetchAll($sql, [
            'categoriesIds' => $categoriesIds,
            'dateFrom' => $dateFrom->format(DateTimeInterface::ATOM),
            'dateTo' => $dateTo->format(DateTimeInterface::ATOM),
        ], [
            'categoriesIds' => ConnectionInterface::TYPE_INTEGER_ARRAY
        ]);

        return $rows ? $this->makeEntitiesFromRows($rows): [];
    }

    public function deleteByCategoryId(int $categoryId): void
    {
        $sql = <<<SQL
DELETE FROM planned_expense
WHERE
    category_id = :categoryId
SQL;

        $this->connection->query($sql, ['categoryId' => $categoryId]);
    }

    /**
     * @param array $rows
     * @return PlannedExpenseEntity[]
     */
    private function makeEntitiesFromRows(array $rows): array
    {
        return array_map(
            fn (array $row): PlannedExpenseEntity => $this->makeEntityFromRow($row),
            $rows
        );
    }

    private function makeEntityFromRow(array $row): PlannedExpenseEntity
    {
        return new PlannedExpenseEntity(
            $row['category_id'],
            $row['amount'],
            $row['currency'],
            $row['will_be_spent_at'] ? new DateTimeImmutable($row['will_be_spent_at']) : null
        );
    }
}