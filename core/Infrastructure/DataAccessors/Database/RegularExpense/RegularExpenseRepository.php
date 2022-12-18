<?php

namespace Core\Infrastructure\DataAccessors\Database\RegularExpense;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;

class RegularExpenseRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(RegularExpenseEntity $regularExpenseEntity): int
    {
        $sql = <<<SQL
INSERT INTO regular_expense
SET
    title = :title,
    user_id = :userId
SQL;

        $this->connection->query($sql, [
            'title' => $regularExpenseEntity->getTitle(),
            'userId' => $regularExpenseEntity->getUserId()
        ]);

        return $this->connection->getLastInsertId();
    }

    public function update(RegularExpenseEntity $regularExpenseEntity): void
    {
        $sql = <<<SQL
UPDATE regular_expense
SET
    title = :title
WHERE
    id = :id
SQL;

        $this->connection->query($sql, [
            'title' => $regularExpenseEntity->getTitle(),
            'id' => $regularExpenseEntity->getId()
        ]);
    }

    public function getByTitleAndUserId(string $title, int $userId): ?RegularExpenseEntity
    {
        $sql = <<<SQL
SELECT * FROM regular_expense WHERE title = :title AND user_id = :userId
SQL;

        $result = $this->connection->fetchOne($sql, [
            'title' => $title,
            'userId' => $userId
        ]);

        return $result ? $this->makeEntityFromRow($result) : null;
    }

    public function getByTitleAndUserIdExcludeId(string $title, int $id, int $userId): ?RegularExpenseEntity
    {
        $sql = <<<SQL
SELECT * FROM regular_expense WHERE title = :title AND user_id = :userId AND id != :id
SQL;

        $result = $this->connection->fetchOne($sql, [
            'title' => $title,
            'userId' => $userId,
            'id' => $id
        ]);

        return $result ? $this->makeEntityFromRow($result) : null;
    }

    /**
     * @param int $userId
     * @return RegularExpenseEntity[]
     */
    public function getAllByUser(int $userId): array
    {
        $sql = <<<SQL
SELECT * FROM regular_expense WHERE user_id = :userId
SQL;

        $result = $this->connection->fetchAll($sql, [
            'userId' => $userId
        ]);

        return $result ? $this->makeEntitiesFromRows($result) : [];
    }

    /**
     * @param array $rows
     * @return RegularExpenseEntity[]
     */
    private function makeEntitiesFromRows(array $rows): array
    {
        return array_map(
            fn (array $row): RegularExpenseEntity => $this->makeEntityFromRow($row),
            $rows
        );
    }

    private function makeEntityFromRow(array $row): RegularExpenseEntity
    {
        return new RegularExpenseEntity(
            $row['id'],
            $row['title'],
            $row['user_id']
        );
    }
}