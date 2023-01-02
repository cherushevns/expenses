<?php

namespace App\Controller\Income;

use App\Controller\AbstractController;
use App\RequestValidator\Income\DeleteValidator;
use Core\UseCase\Income\DeleteUseCase;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class DeleteController extends AbstractController
{
    public function __construct(
        private DeleteValidator $deleteValidator,
        private DeleteUseCase $deleteUseCase
    ) {}

    public function __invoke(ServerRequest $request, Response $response, array $arguments): Response
    {
        $id = (int) $arguments['id'];
        $errors = $this->deleteValidator->validate($id);
        if (! empty($errors)) {
            return $this->sendValidationResponse($errors, $response);
        }

        $this->deleteUseCase->delete($id);

        return $this->sendSuccessResponse([], $response);
    }
}