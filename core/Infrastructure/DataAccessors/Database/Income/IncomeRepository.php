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
    title = :title,
    user_id = :userId,
    amount = :amount,
    currency = :currency,
    earned_at = :earnedAt
SQL;

        $this->connection->query($sql, [
            'title' => $income->getTitle(),
            'userId' => $income->getUserId(),
            'amount' => $income->getAmount(),
            'currency' => $income->getCurrency(),
            'earnedAt' => $income->getEarnedAt()->format(DateTimeInterface::ATOM)
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

    /**
     * @param int $userId
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @return IncomeEntity[]
     */
    public function getByUserIdAndDates(
        int $userId,
        DateTimeImmutable $dateFrom,
        DateTimeImmutable $dateTo
    ): array {
        $sql = <<<SQL
SELECT * FROM income
WHERE
    user_id = :userId AND
    earned_at BETWEEN :dateFrom AND :dateTo
ORDER BY earned_at ASC
SQL;

        $rows = $this->connection->fetchAll($sql, [
            'userId' => $userId,
            'dateFrom' => $dateFrom->format(DateTimeInterface::ATOM),
            'dateTo' => $dateTo->format(DateTimeInterface::ATOM),
        ]);

        return $rows ? $this->makeEntitiesFromRows($rows): [];
    }

    /**
     * @param array $rows
     * @return IncomeEntity[]
     */
    public function makeEntitiesFromRows(array $rows): array
    {
        return array_map(
            fn (array $row): IncomeEntity => $this->makeEntityFromRow($row),
            $rows
        );
    }

    private function makeEntityFromRow(array $row): IncomeEntity
    {
        return new IncomeEntity(
            $row['id'],
            $row['title'],
            $row['user_id'],
            $row['amount'],
            $row['currency'],
            new DateTimeImmutable($row['earned_at'])
        );
    }
}