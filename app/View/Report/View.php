<?php

namespace App\View\Report;

use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\Report\Entity\ActualExpense;
use Core\BusinessRules\Report\Entity\ExpenseCategory;
use Core\BusinessRules\Report\Entity\ExpensePeriod;
use Core\BusinessRules\Report\Entity\IncomeEntry;
use Core\BusinessRules\Report\Entity\IncomePeriod;
use Core\BusinessRules\Report\Entity\RemainPeriod;
use Core\BusinessRules\Report\Entity\Report;
use Core\BusinessRules\Report\Entity\TotalExpensePeriod;
use DateTimeImmutable;

class View
{
    public function toView(Report $report): array
    {
        return [
            'periods' => array_map(
                static fn(DateTimeImmutable $date): string => $date->format('m.Y'),
                $report->getPeriods()
            ),
            'incomes' => [
                'periods' => array_map(
                    fn (IncomePeriod $period): array => [
                        'date' => $period->getDate()->format('m.Y'),
                        'total' => $this->makeViewMoney($period->getTotal()),
                        'entries' => array_map(
                            fn (IncomeEntry $entry): array => [
                                'id' => $entry->getId(),
                                'title' => $entry->getTitle(),
                                'money' => $this->makeViewMoney($entry->getMoney())
                            ],
                            $period->getEntries()
                        )
                    ],
                    $report->getIncomes()->getPeriods()
                )
            ],
            'remains' => [
                'periods' => array_map(
                    fn (RemainPeriod $period): array => [
                        'date' => $period->getDate()->format('m.Y'),
                        'totalActual' => $this->makeViewMoney($period->getTotalActual()),
                        'totalPlanned' => $this->makeViewMoney($period->getTotalPlanned()),
                    ],
                    $report->getRemains()->getPeriods()
                )
            ],
            'totalExpenses' => [
                'periods' => array_map(
                    fn(TotalExpensePeriod $period): array => [
                        'date' => $period->getDate()->format('m.Y'),
                        'planned' => $this->makeViewMoney($period->getPlanned()),
                        'actual' => $this->makeViewMoney($period->getActual()),
                        'limitPercent' => $period->getPercent()
                    ],
                    $report->getTotalExpenses()->getPeriods()
                )
            ],
            'expenses' => [
                'categories' => array_map(
                    fn (ExpenseCategory $category): array => [
                        'id' => $category->getCategoryId(),
                        'name' => 'Test name', // @todo todo
                        'periods' => array_map(
                            fn (ExpensePeriod $period): array => [
                                'date' => $period->getDate()->format('m.Y'),
                                'totalPlanned' => $this->makeViewMoney($period->getTotalPlanned()),
                                'totalActual' => $this->makeViewMoney($period->getTotalActual()),
                                'limitPercent' => $period->getLimitPercent(),
                                'actualExpenses' => array_map(
                                    fn (ActualExpense $actualExpense): array => [
                                        'id' => $actualExpense->getId(),
                                        'title' => $actualExpense->getTitle(),
                                        'money' => $this->makeViewMoney($actualExpense->getMoney()),
                                        'date' => $actualExpense->getSpentAt()->format('d.m.Y')
                                    ],
                                    $period->getActualExpenses()
                                ),
                            ],
                            $category->getPeriods()
                        )
                    ],
                    $report->getExpenses()->getCategories()
                )
            ]
        ];
    }

    private function makeViewMoney(Money $money): array
    {
        return [
            'amount' => $money->getAmount(),
            'currency' => $money->getCurrency()
        ];
    }
}