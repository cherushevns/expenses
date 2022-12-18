<?php

namespace Core\Infrastructure\DataAccessors\Database;

use Doctrine\DBAL\Connection;

interface ConnectionInterface
{
    public const TYPE_STRING_ARRAY = Connection::PARAM_STR_ARRAY;
    public const TYPE_INTEGER_ARRAY = Connection::PARAM_INT_ARRAY;

    public function fetchOne(string $sql, array $parameters = [], array $types = []): mixed;

    public function fetchAll(string $sql, array $parameters = [], array $types = []): array|bool;

    public function query(string $sql, array $parameters = [], array $types = []): int;

    public function getLastInsertId(): int;

}