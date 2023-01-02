<?php

namespace App\Controller\ExpenseCategory;

use App\Controller\AbstractController;
use App\RequestValidator\ExpenseCategory\UpdateValidator;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\BusinessRules\ExpenseCategory\Entity\Type;
use Core\UseCase\ExpenseCategory\UpdateUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class UpdateController extends AbstractController
{
    private UpdateValidator $updateValidator;
    private UpdateUseCase $updateUseCase;

    public function __construct(
        UpdateValidator $updateValidator,
        UpdateUseCase $updateUseCase
    ) {
        $this->updateValidator = $updateValidator;
        $this->updateUseCase = $updateUseCase;
    }

    public function __invoke(ServerRequest $request, Response $response, array $arguments): Response
    {
        $id = (int) $arguments['id'];
        $data = $request->getParsedBody();
        $errors = $this->updateValidator->validate($data, $id);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $expenseCategory = new ExpenseCategory(
            $id,
            null,
            $data['title'],
            new Type($data['type'])
        );

        $this->updateUseCase->update($expenseCategory);

        return $this->sendSuccessResponse(['id' => $id], $response);
    }
}