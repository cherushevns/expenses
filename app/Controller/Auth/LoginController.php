<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use App\RequestValidator\Auth\LoginValidator;
use Core\UseCase\Auth\LoginUserUseCase;
use Slim\Http\ServerRequest;
use Slim\Http\Response;

class LoginController extends AbstractController
{
    public function __construct(
        private LoginValidator $loginValidator,
        private LoginUserUseCase $loginUserUseCase
    ) {}

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $errors = $this->loginValidator->validate($data);
        if (! empty($errors)) {
            return $this->sendValidationResponse(
                $errors,
                $response
            );
        }

        $accessToken = $this->loginUserUseCase->login($data['login']);

        return $this->sendSuccessResponse(
            [
                'accessToken' => $accessToken->getAccessToken(),
                'ttl' => $accessToken->getTtl(),
            ],
            $response
        );
    }
}