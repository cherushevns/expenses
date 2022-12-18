<?php

namespace App\Controller\RegularExpense;

use App\Controller\AbstractController;
use App\View\RegularExpense\RegularExpenseView;
use Core\UseCase\RegularExpense\GetRegularExpensesUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class GetRegularExpensesController extends AbstractController
{
    private GetRegularExpensesUseCase $getRegularExpensesUseCase;
    private RegularExpenseView $regularExpenseView;

    public function __construct(
        GetRegularExpensesUseCase $getRegularExpensesUseCase,
        RegularExpenseView $regularExpenseView
    ) {
        $this->getRegularExpensesUseCase = $getRegularExpensesUseCase;
        $this->regularExpenseView = $regularExpenseView;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $userId = $request->getAttribute('userId');
        $regularExpenses = $this->getRegularExpensesUseCase->get($userId);

        return $this->sendSuccessResponse(
            $this->regularExpenseView->fromBusinessToView($regularExpenses),
            $response
        );
    }
}