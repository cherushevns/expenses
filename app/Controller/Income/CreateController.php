<?php

namespace App\Controller\Income;

use App\Controller\AbstractController;
use App\RequestValidator\Income\CreateValidator;
use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\Income\Entity\Income;
use Core\UseCase\Income\CreateUseCase;
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

        $income = new Income(
            $data['title'],
            new Money(
                $data['amount'],
                $data['currency']
            ),
            DateTimeImmutable::createFromFormat('d.m.Y H:i:s', $data['date'] . ' 00:00:00')
        );

        $this->createUseCase->create($income);

        return $this->sendSuccessResponse([], $response);
    }
}