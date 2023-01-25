<?php

namespace Core\Interactors\Report;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\Report\BuildInterface;
use Core\BusinessRules\Report\Entity\Report;
use Core\Infrastructure\DataAccessors\Database\ActualExpense\ActualExpenseRepository;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryEntity;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Infrastructure\DataAccessors\Database\Income\IncomeRepository;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;
use Core\Interactors\Report\Builder\ReportBuilder;
use DateTimeImmutable;

readonly class BuildAction implements BuildInterface
{
    public function __construct(
        private ExpenseCategoryRepository $expenseCategoryRepository,
        private PlannedExpenseRepository $plannedExpenseRepository,
        private ActualExpenseRepository $actualExpenseRepository,
        private IncomeRepository $incomeRepository,
        private GetAuthorizedUserIdInterface $getAuthorizedUserId,
        private ReportBuilder $reportBuilder
    ) {}

    public function build(
        DateTimeImmutable $dateFrom,
        DateTimeImmutable $dateTo
    ): Report {
        $userId = $this->getAuthorizedUserId->get();

        $userCategories = $this->expenseCategoryRepository->getByUserId($userId);
        $categoriesIds = array_map(
            static fn (ExpenseCategoryEntity $expenseCategoryEntity): int => $expenseCategoryEntity->getId(),
            $userCategories
        );

        $plannedExpenses = $this->plannedExpenseRepository->getByCategoriesIdsAndDates(
            $categoriesIds,
            $dateFrom,
            $dateTo
        );

        $actualExpenses = $this->actualExpenseRepository->getByCategoriesIdsAndDates(
            $categoriesIds,
            $dateFrom,
            $dateTo
        );

        $incomes = $this->incomeRepository->getByUserIdAndDates(
            $userId,
            $dateFrom,
            $dateTo
        );

        return $this->reportBuilder->build(
            $userCategories,
            $plannedExpenses,
            $actualExpenses,
            $incomes,
            $dateFrom,
            $dateTo
        );
    }
}