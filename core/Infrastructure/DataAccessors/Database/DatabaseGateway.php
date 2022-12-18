<?php

namespace Core\Infrastructure\DataAccessors\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class DatabaseGateway implements ConnectionInterface
{
    private static Connection $connection;

    public function __construct(Connection $connection)
    {
        self::$connection = $connection;
    }

    /**
     * @param string $sql
     * @param <string, string>[] $parameters
     * @param <string, string>[] $types
     * @return array|bool
     * @throws Exception
     */
    public function fetchOne(string $sql, array $parameters = [], array $types = []): array|bool
    {
        return self::$connection->fetchAssociative($sql, $parameters, $types);
    }

    /**
     * @param string $sql
     * @param <string, string>[] $parameters
     * @param <string, string>[] $types
     * @return list<array<string,mixed>>
     * @throws Exception
     */
    public function fetchAll(string $sql, array $parameters = [], array $types = []): array
    {
        return self::$connection->fetchAllAssociative($sql, $parameters, $types);
    }

    /**
     * @param string $sql
     * @param <string, string>[] $parameters
     * @param <string, string>[] $types
     * @return int Affected rows
     * @throws Exception
     */
    public function query(string $sql, array $parameters = [], array $types = []): int
    {
        return self::$connection->executeQuery($sql, $parameters, $types)->rowCount();
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getLastInsertId(): int
    {
        return self::$connection->lastInsertId();
    }
}