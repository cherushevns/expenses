<?php

namespace App\Controller\Expense;

use App\Controller\AbstractController;
use App\RequestValidator\Expense\UpdateValidator;
use Core\BusinessRules\Expense\Entity\Expense;
use Core\BusinessRules\Expense\Entity\Type;
use Core\UseCase\Expense\UpdateUseCase;
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

        $expense = new Expense(
            $id,
            null,
            $data['title'],
            new Type($data['type'])
        );

        $this->updateUseCase->update($expense);

        return $this->sendSuccessResponse(['id' => $id], $response);
    }
}