<?php

namespace Core\Interactors\Report\Builder;

use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\Report\Entity\ActualExpense;
use Core\BusinessRules\Report\Entity\ExpenseCategory;
use Core\BusinessRules\Report\Entity\ExpensePeriod;
use Core\BusinessRules\Report\Entity\Expenses;
use Core\BusinessRules\Report\Entity\IncomeEntry;
use Core\BusinessRules\Report\Entity\IncomePeriod;
use Core\BusinessRules\Report\Entity\Incomes;
use Core\BusinessRules\Report\Entity\RemainPeriod;
use Core\BusinessRules\Report\Entity\Remains;
use Core\BusinessRules\Report\Entity\Report;
use Core\BusinessRules\Report\Entity\TotalExpensePeriod;
use Core\BusinessRules\Report\Entity\TotalExpenses;
use Core\Infrastructure\DataAccessors\Database\ActualExpense\ActualExpenseEntity;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryEntity;
use Core\Infrastructure\DataAccessors\Database\Income\IncomeEntity;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseEntity;
use DateInterval;
use DatePeriod;
use DateTimeImmutable;
use RuntimeException;

class ReportBuilder
{
    private const DEFAULT_CURRENCY = 'RUB';

    /**
     * @param ExpenseCategoryEntity[] $expenseCategories
     * @param PlannedExpenseEntity[] $plannedExpenses
     * @param ActualExpenseEntity[] $actualExpenses
     * @param IncomeEntity[] $incomes
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @return Report
     */
    public function build(
        array $expenseCategories,
        array $plannedExpenses,
        array $actualExpenses,
        array $incomes,
        DateTimeImmutable $dateFrom,
        DateTimeImmutable $dateTo
    ): Report {
        $reportPeriods = $this->resolvePeriodsFromDates($dateFrom, $dateTo);
        $reportIncomes = $this->buildReportIncomes($incomes, $reportPeriods);
        $reportExpenses = $this->buildReportExpenses(
            $expenseCategories,
            $actualExpenses,
            $plannedExpenses,
            $reportPeriods
        );
        $reportTotalExpenses = $this->buildReportTotalExpenses($reportExpenses);
        $reportRemains = $this->buildReportRemains(
            $reportIncomes,
            $reportTotalExpenses
        );

        return new Report(
            $reportPeriods,
            $reportIncomes,
            $reportRemains,
            $reportExpenses,
            $reportTotalExpenses
        );
    }

    /**
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @return DateTimeImmutable[]
     */
    private function resolvePeriodsFromDates(DateTimeImmutable $dateFrom, DateTimeImmutable $dateTo): array
    {
        $result = [];
        $interval = DateInterval::createFromDateString('1 month');
        $dateTo = $dateTo->add(new DateInterval('PT5M')); // Костыль чтоб добавился последний месяц
        $period = new DatePeriod($dateFrom, $interval, $dateTo);
        foreach ($period as $dateTime) {
            $result[] = $dateTime;
        }

        return $result;
    }

    /**
     * @param IncomeEntity[] $incomes
     * @param DateTimeImmutable[] $dates
     * @return Incomes
     */
    private function buildReportIncomes(array $incomes, array $dates): Incomes
    {
        $periods = [];
        foreach ($dates as $date) {
            $entries = $this->resolveIncomesEntries($incomes, $date);
            $periods[] = new IncomePeriod(
                $date,
                ! empty($entries) ? $this->calculateTotalByIncomesEntries($entries) : $this->makeDefaultMoney(),
                $entries
            );
        }

        return new Incomes($periods);
    }

    /**
     * @param IncomeEntity[] $incomes
     * @param DateTimeImmutable $date
     * @return IncomeEntry[]
     */
    private function resolveIncomesEntries(array $incomes, DateTimeImmutable $date): array
    {
        $entries = [];
        foreach ($incomes as $income) {
            if ($income->getEarnedAt()->getTimestamp() === $date->getTimestamp()) {
                $entries[] = new IncomeEntry(
                    $income->getId(),
                    $income->getTitle(),
                    $this->makeMoney($income->getAmount(), $income->getCurrency()),
                    $income->getEarnedAt()
                );
            }
        }

        return $entries;
    }

    /**
     * @param IncomeEntry[] $entries
     * @return Money
     */
    private function calculateTotalByIncomesEntries(array $entries): Money
    {
        $result = $this->makeDefaultMoney();

        foreach ($entries as $entry) {
            if (! $result) {
                $result = $entry->getMoney();
            } else {
                $result = $result->add($entry->getMoney());
            }
        }

        return $result;
    }

    /**
     * @param ExpenseCategoryEntity[] $expenseCategories
     * @param ActualExpenseEntity[] $actualExpenses
     * @param PlannedExpenseEntity[] $plannedExpenses
     * @param DateTimeImmutable[] $dates
     * @return Expenses
     */
    private function buildReportExpenses(
        array $expenseCategories,
        array $actualExpenses,
        array $plannedExpenses,
        array $dates
    ): Expenses {
        $categories = [];
        foreach ($expenseCategories as $expenseCategory) {
            $periods = [];
            foreach ($dates as $date) {
                $reportActualExpenses = $this->resolveActualExpensesByCategoryAndDate(
                    $actualExpenses,
                    $expenseCategory->getId(),
                    $date
                );
                $totalPlanned = $this->calculateTotalPlannedByCategoryAndDate(
                    $plannedExpenses,
                    $expenseCategory->getId(),
                    $date
                );
                $totalActual = ! empty($reportActualExpenses)
                    ? $this->calculateTotalActualByExpenses($reportActualExpenses)
                    : $this->makeDefaultMoney();

                $periods[] = new ExpensePeriod(
                    $date,
                    $totalPlanned,
                    $totalActual,
                    $this->calculatePercentForPlannedAndActual($totalPlanned, $totalActual),
                    $reportActualExpenses
                );
            }

            $categories[] = new ExpenseCategory(
                $expenseCategory->getId(),
                $expenseCategory->getType(),
                $periods
            );
        }

        return new Expenses($categories);
    }

    /**
     * @param ActualExpenseEntity[] $actualExpenses
     * @param int $categoryId
     * @param DateTimeImmutable $date
     * @return ActualExpense[]
     */
    private function resolveActualExpensesByCategoryAndDate(
        array $actualExpenses,
        int $categoryId,
        DateTimeImmutable $date
    ): array {
        $result = [];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $date->format('m'), $date->format('Y'));

        $dateFrom = DateTimeImmutable::createFromFormat(
            'Y-m-d H:i:s',
            $date->format('Y-m') . '-01 00:00:00'
        );
        $dateTo = DateTimeImmutable::createFromFormat(
            'Y-m-d H:i:s',
            $date->format('Y-m') . '-' . $daysInMonth . ' 00:00:00'
        );
        foreach ($actualExpenses as $actualExpense) {
            if (
                $actualExpense->getSpentAt()->getTimestamp() >= $dateFrom->getTimestamp()
                && $actualExpense->getSpentAt()->getTimestamp() <= $dateTo->getTimestamp()
                && $actualExpense->getCategoryId() === $categoryId
            ) {
                $result[] = new ActualExpense(
                    $actualExpense->getId(),
                    $actualExpense->getTitle(),
                    $this->makeMoney(
                        $actualExpense->getAmount(),
                        $actualExpense->getCurrency()
                    ),
                    $actualExpense->getSpentAt()
                );
            }
        }

        return $result;
    }

    /**
     * @param PlannedExpenseEntity[] $plannedExpenses
     * @param int $categoryId
     * @param DateTimeImmutable $date
     * @return Money
     */
    private function calculateTotalPlannedByCategoryAndDate(
        array $plannedExpenses,
        int $categoryId,
        DateTimeImmutable $date
    ): Money {
        // Сначала смотрим есть ли запланированный расход по конкретной дате
        foreach ($plannedExpenses as $plannedExpense) {
            if (
                $plannedExpense->getCategoryId() === $categoryId
                && $plannedExpense->getWillBeSpentAt()
                && $plannedExpense->getWillBeSpentAt()->getTimestamp() === $date->getTimestamp()
            ) {
                return $this->makeMoney($plannedExpense->getAmount(), $plannedExpense->getCurrency());
            }
        }

        foreach ($plannedExpenses as $plannedExpense) {
            if (
                $plannedExpense->getCategoryId() === $categoryId
            ) {
                return $this->makeMoney($plannedExpense->getAmount(), $plannedExpense->getCurrency());
            }
        }

        return $this->makeDefaultMoney();
    }

    /**
     * @param ActualExpense[] $actualExpenses
     * @return Money
     */
    private function calculateTotalActualByExpenses(array $actualExpenses): Money
    {
        $result = $this->makeDefaultMoney();

        foreach ($actualExpenses as $actualExpense) {
            if (! $result) {
                $result = $actualExpense->getMoney();
            } else {
                $result = $result->add($actualExpense->getMoney());
            }
        }

        return $result;
    }

    private function buildReportTotalExpenses(Expenses $expenses): TotalExpenses
    {
        $periods = [];
        $plannedByDates = $actualByDates = [];

        foreach ($expenses->getCategories() as $category) {
            foreach ($category->getPeriods() as $period) {
                $plannedByDates[$period->getDate()->getTimestamp()][] = $period->getTotalPlanned();
                $actualByDates[$period->getDate()->getTimestamp()][] = $period->getTotalActual();
            }
        }

        foreach ($plannedByDates as $timestamp => $plannedByDate) {
            $planned = $this->calculateTotalFromMoneyArray($plannedByDate);
            $actual = $this->calculateTotalFromMoneyArray($actualByDates[$timestamp]);
            $periods[] = new TotalExpensePeriod(
                new DateTimeImmutable('@' . $timestamp),
                $planned,
                $actual,
                $this->calculatePercentForPlannedAndActual($planned, $actual)
            );
        }

        return new TotalExpenses($periods);
    }

    private function buildReportRemains(
        Incomes $incomes,
        TotalExpenses $totalExpenses
    ): Remains {
        // @todo impl remain from last period!!!
        $remainsPeriods = [];
        foreach ($incomes->getPeriods() as $period) {
            $expensePeriod = $this->resolveExpensePeriodByDate($totalExpenses, $period->getDate());
            $planned = $expensePeriod ? $expensePeriod->getPlanned() : $this->makeDefaultMoney();
            $actual = $expensePeriod ? $expensePeriod->getActual() : $this->makeDefaultMoney();
            $remainPlanned = $period->getTotal()->sub($planned);
            $remainActual = $period->getTotal()->sub($actual);
            $remainsPeriods[] = new RemainPeriod(
                $period->getDate(),
                $remainPlanned,
                $remainActual,
                $this->calculatePercentForPlannedAndActual($remainPlanned, $remainActual)
            );
        }

        return new Remains($remainsPeriods);
    }

    private function resolveExpensePeriodByDate(
        TotalExpenses $totalExpenses,
        DateTimeImmutable $date
    ): ?TotalExpensePeriod {
        foreach ($totalExpenses->getPeriods() as $period) {
            if ($period->getDate()->getTimestamp() === $date->getTimestamp()) {
                return $period;
            }
        }

        return null;
    }

    /**
     * @param Money[] $moneys
     * @return Money
     */
    private function calculateTotalFromMoneyArray(array $moneys): Money
    {
        $result = $this->makeDefaultMoney();

        foreach ($moneys as $money) {
            $result = $result->add($money);
        }

        return $result;
    }

    private function calculatePercentForPlannedAndActual(Money $planned, Money $actual): float
    {
        $planned = $planned->getAmount() !== 0.0 ? $planned->getAmount() : 1;
        $actual = $actual->getAmount() !== 0.0 ? $actual->getAmount() : 1;

        return bcmul(bcdiv($actual, $planned, 2), 100, 2);
    }

    private function makeMoney(float $amount, string $currency): Money
    {
        return new Money(
            $amount,
            $currency
        );
    }

    private function makeDefaultMoney(): Money
    {
        return new Money(
            0.0,
            self::DEFAULT_CURRENCY
        );
    }
}