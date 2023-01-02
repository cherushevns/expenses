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
        $this->createPlannedExpenseTable();
        $this->createActualExpenseTable();
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

    private function createPlannedExpenseTable(): void
    {
        $sql = <<<SQL
-- auto-generated definition
create table planned_expense
(
    id                  int auto_increment
        primary key,
    category_id         int(11) not null,
    amount              decimal(16,2) not null,
    currency            varchar(255) not null,
    will_be_spent_at    datetime
);
SQL;
        $this->query($sql);
    }

    private function createActualExpenseTable(): void
    {
        $sql = <<<SQL
-- auto-generated definition
create table actual_expense
(
    id                  int auto_increment
        primary key,
    category_id         int(11) not null,
    amount              decimal(16,2) not null,
    currency            varchar(255) not null,
    title               varchar(255) not null,
    spent_at            datetime not null
);
SQL;
        $this->query($sql);
    }
}
