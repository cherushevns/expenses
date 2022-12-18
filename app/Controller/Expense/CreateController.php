<?php

namespace App\Controller\Expense;

use App\Controller\AbstractController;
use App\RequestValidator\Expense\CreateValidator;
use Core\BusinessRules\Expense\Entity\Expense;
use Core\BusinessRules\Expense\Entity\Type;
use Core\UseCase\Expense\CreateUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class CreateController extends AbstractController
{
    private CreateValidator $createValidator;
    private CreateUseCase $createUseCase;

    public function __construct(
        CreateValidator $createValidator,
        CreateUseCase $createUseCase
    ) {
        $this->createValidator = $createValidator;
        $this->createUseCase = $createUseCase;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $errors = $this->createValidator->validate($data);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $expense = new Expense(
            null,
            null,
            $data['title'],
            new Type($data['type'])
        );

        $expenseId = $this->createUseCase->create($expense);

        return $this->sendSuccessResponse(['id' => $expenseId], $response);
    }
}