<?php

namespace App\Controller\RegularExpense;

use App\Controller\AbstractController;
use App\RequestValidator\RegularExpense\CreateValidator;
use Core\BusinessRules\RegularExpense\RegularExpense;
use Core\UseCase\RegularExpense\CreateRegularExpenseUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class CreateRegularExpenseController extends AbstractController
{
    private CreateValidator $createValidator;
    private CreateRegularExpenseUseCase $createRegularExpenseUseCase;

    public function __construct(
        CreateValidator $createValidator,
        CreateRegularExpenseUseCase $createRegularExpenseUseCase
    ) {
        $this->createValidator = $createValidator;
        $this->createRegularExpenseUseCase = $createRegularExpenseUseCase;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $userId = $request->getAttribute('userId');
        $errors = $this->createValidator->validate($data, $userId);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $regularExpense = new RegularExpense(
            null,
            $data['title'],
            $userId
        );

        $regularExpenseId = $this->createRegularExpenseUseCase->create($regularExpense);

        return $this->sendSuccessResponse(['id' => $regularExpenseId], $response);
    }
}