<?php

namespace App\Controller\RegularExpense;

use App\Controller\AbstractController;
use App\RequestValidator\RegularExpense\UpdateValidator;
use Core\BusinessRules\RegularExpense\RegularExpense;
use Core\UseCase\RegularExpense\UpdateRegularExpenseUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class UpdateRegularExpenseController extends AbstractController
{
    private UpdateValidator $updateValidator;
    private UpdateRegularExpenseUseCase $updateRegularExpenseUseCase;

    public function __construct(
        UpdateValidator $updateValidator,
        UpdateRegularExpenseUseCase $updateRegularExpenseUseCase
    ) {
        $this->updateValidator = $updateValidator;
        $this->updateRegularExpenseUseCase = $updateRegularExpenseUseCase;
    }

    public function __invoke(ServerRequest $request, Response $response, array $arguments): Response
    {
        $id = (int) $arguments['id'];
        $data = $request->getParsedBody();
        $userId = $request->getAttribute('userId');
        $errors = $this->updateValidator->validate($data, $id, $userId);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $regularExpense = new RegularExpense(
            $id,
            $data['title'],
            $userId
        );

        $this->updateRegularExpenseUseCase->update($regularExpense);

        return $this->sendSuccessResponse(['id' => $id], $response);
    }
}