<?php

namespace App\Controller\Auth;

use App\Controller\AbstractController;
use App\RequestValidator\Auth\RegisterValidator;
use Core\BusinessRules\Auth\UserCreateRequest;
use Core\UseCase\Auth\RegisterUserUseCase;
use Slim\Http\ServerRequest;
use Slim\Http\Response;

class RegisterController extends AbstractController
{
    private RegisterValidator $registerValidator;
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(
        RegisterValidator $registerValidator,
        RegisterUserUseCase $registerUserUseCase
    ) {
        $this->registerValidator = $registerValidator;
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $errors = $this->registerValidator->validate($data);
        if (! empty($errors)) {
            return $this->sendValidationResponse(
                $errors,
                $response
            );
        }

        $userCreateRequest = new UserCreateRequest(
            $data['name'],
            $data['login'],
            $data['email'],
            $data['password']
        );

        $accessToken = $this->registerUserUseCase->register($userCreateRequest);

        return $this->sendSuccessResponse(
            [
                'accessToken' => $accessToken->getAccessToken(),
                'ttl' => $accessToken->getTtl(),
            ],
            $response
        );
    }
}