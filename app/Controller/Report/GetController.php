<?php

namespace App\Controller\Report;

use App\Controller\AbstractController;
use App\RequestValidator\Report\GetValidator;
use App\View\Report\View;
use Core\UseCase\Report\GetUseCase;
use DateTimeImmutable;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class GetController extends AbstractController
{
    public function __construct(
        private GetUseCase $getUseCase,
        private GetValidator $getValidator,
        private View $view
    ) {}

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $parameters = $request->getParams();
        $errors = $this->getValidator->validate($parameters);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $dateTo = DateTimeImmutable::createFromFormat('m.Y', $parameters['to']);
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $dateTo->format('m'), $dateTo->format('Y'));

        $report = $this->getUseCase->get(
            DateTimeImmutable::createFromFormat('d.m.Y H:i:s', '01.' . $parameters['from'] . ' 00:00:00'),
            DateTimeImmutable::createFromFormat('d.m.Y H:i:s', $daysInMonth . '.' . $parameters['to'] . ' 00:00:00'),
        );

        return $this->sendSuccessResponse(
            $this->view->toView($report),
            $response
        );
    }
}