<?php

namespace Core\Infrastructure\DataAccessors\Database\Income;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;

use DateTimeInterface;
use DateTimeImmutable;

class IncomeRepository
{
    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(IncomeEntity $income): void
    {
        $sql = <<<SQL
INSERT INTO income
SET
    user_id = :userId,
    amount = :amount,
    currency = :currency,
    earned_at = :earnedAt
SQL;

        $this->connection->query($sql, [
            'userId' => $income->getUserId(),
            'amount' => $income->getAmount(),
            'currency' => $income->getCurrency(),
            'willBeSpentAt' => $income->getEarnedAt()->format(DateTimeInterface::ATOM)
        ]);
    }

    public function deleteById(int $id): void
    {
        $sql = <<<SQL
DELETE FROM income
WHERE
    id = :id
SQL;

        $this->connection->query($sql, ['id' => $id]);
    }

    public function getByIdAndUserId(int $id, int $userId): ?IncomeEntity
    {
        $sql = <<<SQL
SELECT * FROM income
WHERE
    id = :id AND
    user_id = :userId
SQL;

        $row = $this->connection->fetchOne($sql, [
            'id' => $id,
            'userId' => $userId
        ]);

        return $row ? $this->makeEntityFromRow($row): null;
    }

    private function makeEntityFromRow(array $row): IncomeEntity
    {
        return new IncomeEntity(
            $row['user_id'],
            $row['amount'],
            $row['currency'],
            new DateTimeImmutable($row['earned_at'])
        );
    }
}