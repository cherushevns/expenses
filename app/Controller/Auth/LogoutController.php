<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use Core\UseCase\Auth\LogoutUserUseCase;
use Slim\Http\ServerRequest;
use Slim\Http\Response;

class LogoutController extends AbstractController
{
    public function __construct(
        private LogoutUserUseCase $logoutUserUseCase
    ) {}

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $this->logoutUserUseCase->logout();

        return $this->sendSuccessResponse(
            [],
            $response
        );
    }
}