<?php

namespace App\Controller\ExpenseCategory;

use App\Controller\AbstractController;
use App\View\Expense\ExpenseView;
use Core\UseCase\ExpenseCategory\GetAllUseCase;
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
        $expenses = $this->getAllUseCase->get();

        return $this->sendSuccessResponse(
            $this->expenseView->fromBusinessToView($expenses),
            $response
        );
    }
}