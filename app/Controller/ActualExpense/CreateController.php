<?php

namespace App\Controller\ActualExpense;

use App\Controller\AbstractController;
use App\RequestValidator\ActualExpense\CreateValidator;
use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\ActualExpense\Entity\ActualExpense;
use Core\UseCase\ActualExpense\CreateUseCase;
use DateTimeImmutable;
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

        $plannedExpense = new ActualExpense(
            $data['categoryId'],
            $data['title'],
            new Money(
                $data['amount'],
                $data['currency']
            ),
            new DateTimeImmutable($data['date'] . ' 00:00:00')
        );

        $this->createUseCase->create($plannedExpense);

        return $this->sendSuccessResponse([], $response);
    }
}