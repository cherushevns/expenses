<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class InitTablesMigration extends AbstractMigration
{
    public function change()
    {
        $this->createAccessTokenTable();
        $this->createExpenseCategoryTable();
        $this->createUserTable();
    }

    private function createAccessTokenTable(): void
    {
        $sql = <<<SQL
-- auto-generated definition
create table access_token
(
    user_id      int          not null,
    access_token varchar(255) not null,
    expires_at   datetime     not null
);
SQL;
        $this->query($sql);
    }

    private function createExpenseCategoryTable(): void
    {
        $sql = <<<SQL
-- auto-generated definition
create table expense_category
(
    id      int auto_increment
        primary key,
    title   varchar(255) not null,
    user_id int          null,
    type    int          not null
);
SQL;
        $this->query($sql);
    }

    private function createUserTable(): void
    {
        $sql = <<<SQL
-- auto-generated definition
create table user
(
    id            int auto_increment
        primary key,
    name          varchar(255) not null,
    login         varchar(255) not null,
    email         varchar(255) not null,
    password      varchar(255) not null,
    password_hash varchar(255) not null
);
SQL;
        $this->query($sql);
    }
}
