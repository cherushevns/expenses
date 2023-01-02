<?php

namespace App\Controller\PlannedExpense;

use App\Controller\AbstractController;
use App\RequestValidator\PlannedExpense\CreateValidator;
use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\PlannedExpense\Entity\MonthAndYear;
use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\UseCase\PlannedExpense\CreateUseCase;
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

        $plannedExpense = new PlannedExpense(
            $data['categoryId'],
            new Money(
                $data['amount'],
                $data['currency']
            ),
            ! empty($data['date'])
                ? new DateTimeImmutable($data['date'] . '-01 00:00:00') // crutch?
                : null
        );

        $this->createUseCase->create($plannedExpense);

        return $this->sendSuccessResponse([], $response);
    }
}