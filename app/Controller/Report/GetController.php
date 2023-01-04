<?php

namespace App\Controller\Report;

use App\Controller\AbstractController;
use App\RequestValidator\Report\GetValidator;
use App\View\Report\View;
use Core\UseCase\Report\GetUseCase;
use DateTimeImmutable;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class GetController extends AbstractController
{
    public function __construct(
        private GetUseCase $getUseCase,
        private GetValidator $getValidator,
        private View $view
    ) {}

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $parameters = $request->getParams();
        $errors = $this->getValidator->validate($parameters);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $report = $this->getUseCase->get(
            DateTimeImmutable::createFromFormat('d.m.Y H:i:s', '01.' . $parameters['from'] . ' 00:00:00'),
            DateTimeImmutable::createFromFormat('d.m.Y H:i:s', '01.' . $parameters['to'] . ' 00:00:00'),
        );

        return $this->sendSuccessResponse(
            $this->view->toView($report),
            $response
        );
    }
}


/**
periods: [
    {
        date: 2022-12,
    },
    {
        date: 2022-12,
    }
],
incomes: { // Доходы - возможно позже вкорячу планируемые доходы
    periods: {
        date: 2022-12,
        total: {
            amount: 20000,
            currency: RUB,
        }
        entries: {
            {
                id: 1,
                title: Аванс,
                amount: 10000,
                currency: RUB
            }, {
                id: 2,
                title: Зарплата,
                amount: 10000,
                currency: RUB
            }
        }
},
remains: { // Остатки
    periods: [
        {
            date: 2022-12,
            totalActual: {
                amount: 18500,
                currency: RUB,
            },
            totalPlanned: {
                amount: 18500,
                currency: RUB,
            }
        }, {
            date: 2022-12,
            totalActual: {
                amount: 0,
                currency: RUB,
            },
            totalPlanned: {
                amount: 18500,
                currency: RUB,
            }
        },
    ]
}
totalExpenses: { // Общие расходы за периоды
    periods: [
        {
            date: 2022-12,
            planned: {
                amount: 1000,
                currency: RUB
            },
            actual: {
                amount: 1500,
                currency: RUB
            },
            limitPercent: 150
        }
    ]
}
expenses: { // Расходы по категориям за периоды
    categories: {
        id: 1,
        title: Еда домой // just on view
        periods: [
            {
                date: 2022-12,
                totalPlanned: {
                    amount: 1000,
                    currency: RUB
                },
                totalActual: {
                    amount: 1500,
                    currency: RUB
                }
                limitPercent: 150,
                actualExpenses: {
                    {
                        id: 1,
                        title: 'Яблоко',
                        amount: 750,
                        currency: RUB,
                        date: 2022-12-01
                    }, {
                        id: 2,
                        title: 'Яблоко',
                        amount: 750,
                        currency: RUB,
                        date: 2022-12-02
                    }
                }
            }, {
                date: 2023-01,
                totalPlanned: {
                    amount: 2000,
                    currency: RUB
                },
                totalActual: {
                    amount: 0,
                    currency: RUB
                }
                limitPercent: 0,
                actualExpenses: {}
            },
        ]
    }
}
 */