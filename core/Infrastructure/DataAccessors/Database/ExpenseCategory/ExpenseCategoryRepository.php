<?php

namespace Core\Infrastructure\DataAccessors\Database\ExpenseCategory;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;

class ExpenseCategoryRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(ExpenseCategoryEntity $expenseCategory): int
    {
        $sql = <<<SQL
INSERT INTO expense_category
SET
    title = :title,
    user_id = :userId,
    type = :type
SQL;

        $this->connection->query($sql, [
            'title' => $expenseCategory->getTitle(),
            'userId' => $expenseCategory->getUserId(),
            'type' => $expenseCategory->getType()
        ]);

        return $this->connection->getLastInsertId();
    }

    public function update(ExpenseCategoryEntity $expenseCategory): void
    {
        $sql = <<<SQL
UPDATE expense_category
SET
    title = :title,
    type = :type
WHERE
    id = :id
SQL;

        $this->connection->query($sql, [
            'title' => $expenseCategory->getTitle(),
            'type' => $expenseCategory->getType(),
            'id' => $expenseCategory->getId()
        ]);
    }

    public function checkIsExists(ExpenseCategoryEntity $expenseCategory): bool
    {
        $addWhere = '';
        $addParameters = [];

        if ($expenseCategory->getId()) {
            $addWhere .= ' AND id != :id ';
            $addParameters['id'] = $expenseCategory->getId();
        }

        $sql = <<<SQL
SELECT * FROM expense_category 
WHERE 
    type = :type AND 
    title = :title AND
    user_id = :userId
    $addWhere
SQL;

        return (bool) $this->connection->fetchOne($sql, array_merge([
            'type' => $expenseCategory->getType(),
            'title' => $expenseCategory->getTitle(),
            'userId' => $expenseCategory->getUserId()
        ], $addParameters));
    }

    public function getByIdAndUserId(int $id, int $userId): ?ExpenseCategoryEntity
    {
        $sql = <<<SQL
SELECT * FROM expense_category
WHERE
    id = :id AND
    user_id = :userId
SQL;

        $row = $this->connection->fetchOne($sql, [
            'id' => $id,
            'userId' => $userId
        ]);

        return $row ? $this->makeEntityFromRow($row) : null;
    }

    /**
     * @param int $userId
     * @return ExpenseCategoryEntity[]
     */
    public function getByUserId(int $userId): array
    {
        $sql = <<<SQL
SELECT * FROM expense_category
WHERE
    user_id = :userId
SQL;

        $rows = $this->connection->fetchAll($sql, [
            'userId' => $userId
        ]);

        return $rows ? $this->makeEntitiesFromRows($rows) : [];
    }

    public function deleteById(int $id): void
    {
        $sql = <<<SQL
DELETE FROM expense_category WHERE id = :id
SQL;

        $this->connection->query($sql, ['id' => $id]);
    }

    /**
     * @param array $rows
     * @return ExpenseCategoryEntity[]
     */
    private function makeEntitiesFromRows(array $rows): array
    {
        return array_map(
            fn (array $row): ExpenseCategoryEntity => $this->makeEntityFromRow($row),
            $rows
        );
    }

    private function makeEntityFromRow(array $row): ExpenseCategoryEntity
    {
        return new ExpenseCategoryEntity(
            $row['id'],
            $row['title'],
            $row['user_id'],
            $row['type']
        );
    }
}