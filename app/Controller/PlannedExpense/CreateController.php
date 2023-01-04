<?php

namespace App\Controller\PlannedExpense;

use App\Controller\AbstractController;
use App\RequestValidator\PlannedExpense\CreateValidator;
use Core\BusinessRules\Common\Money\Money;
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
                ? DateTimeImmutable::createFromFormat('d.m.Y H:i:s', '01.' . $data['date'] . ' 00:00:00')
                : null
        );

        $this->createUseCase->create($plannedExpense);

        return $this->sendSuccessResponse([], $response);
    }
}