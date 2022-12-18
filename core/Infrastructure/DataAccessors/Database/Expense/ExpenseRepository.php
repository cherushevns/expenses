<?php

namespace Core\Infrastructure\DataAccessors\Database\Expense;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;

class ExpenseRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(ExpenseEntity $expenseEntity): int
    {
        $sql = <<<SQL
INSERT INTO expense
SET
    title = :title,
    user_id = :userId,
    type = :type
SQL;

        $this->connection->query($sql, [
            'title' => $expenseEntity->getTitle(),
            'userId' => $expenseEntity->getUserId(),
            'type' => $expenseEntity->getType()
        ]);

        return $this->connection->getLastInsertId();
    }

    public function update(ExpenseEntity $expenseEntity): void
    {
        $sql = <<<SQL
UPDATE expense
SET
    title = :title,
    type = :type
WHERE
    id = :id
SQL;

        $this->connection->query($sql, [
            'title' => $expenseEntity->getTitle(),
            'type' => $expenseEntity->getType(),
            'id' => $expenseEntity->getId()
        ]);
    }

    public function checkIsExists(ExpenseEntity $expenseEntity): bool
    {
        $addWhere = '';
        $addParameters = [];

        if ($expenseEntity->getId()) {
            $addWhere .= ' AND id != :id ';
            $addParameters['id'] = $expenseEntity->getId();
        }

        $sql = <<<SQL
SELECT * FROM expense 
WHERE 
    type = :type AND 
    title = :title AND
    user_id = :userId
    $addWhere
SQL;

        return (bool) $this->connection->fetchOne($sql, array_merge([
            'type' => $expenseEntity->getType(),
            'title' => $expenseEntity->getTitle(),
            'userId' => $expenseEntity->getUserId()
        ], $addParameters));

    }

    /**
     * @param int $userId
     * @return ExpenseEntity[]
     */
    public function getAllByUser(int $userId): array
    {
        $sql = <<<SQL
SELECT * FROM expense WHERE user_id = :userId
SQL;

        $result = $this->connection->fetchAll($sql, [
            'userId' => $userId
        ]);

        return $result ? $this->makeEntitiesFromRows($result) : [];
    }

    /**
     * @param array $rows
     * @return ExpenseEntity[]
     */
    private function makeEntitiesFromRows(array $rows): array
    {
        return array_map(
            fn (array $row): ExpenseEntity => $this->makeEntityFromRow($row),
            $rows
        );
    }

    private function makeEntityFromRow(array $row): ExpenseEntity
    {
        return new ExpenseEntity(
            $row['id'],
            $row['title'],
            $row['user_id'],
            $row['type']
        );
    }
}