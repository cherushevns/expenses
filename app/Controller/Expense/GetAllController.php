<?php

namespace App\Controller\Expense;

use App\Controller\AbstractController;
use App\View\Expense\ExpenseView;
use Core\UseCase\Expense\GetAllUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class GetAllController extends AbstractController
{
    private GetAllUseCase $getAllUseCase;
    private ExpenseView $expenseView;

    public function __construct(
        GetAllUseCase $getAllUseCase,
        ExpenseView $expenseView
    ) {
        $this->getAllUseCase = $getAllUseCase;
        $this->expenseView = $expenseView;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $userId = $request->getAttribute('userId');
        $expenses = $this->getAllUseCase->get($userId);

        return $this->sendSuccessResponse(
            $this->expenseView->fromBusinessToView($expenses),
            $response
        );
    }
}