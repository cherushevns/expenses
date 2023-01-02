<?php

namespace App\Controller\ExpenseCategory;

use App\Controller\AbstractController;
use App\RequestValidator\ExpenseCategory\CreateValidator;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\BusinessRules\ExpenseCategory\Entity\Type;
use Core\UseCase\ExpenseCategory\CreateUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class CreateController extends AbstractController
{
    public function __construct(
        private CreateValidator $createValidator,
        private CreateUseCase $createUseCase
    ) {}

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $errors = $this->createValidator->validate($data);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $expenseCategory = new ExpenseCategory(
            null,
            null,
            $data['title'],
            new Type($data['type'])
        );

        $expenseCategoryId = $this->createUseCase->create($expenseCategory);

        return $this->sendSuccessResponse(['id' => $expenseCategoryId], $response);
    }
}