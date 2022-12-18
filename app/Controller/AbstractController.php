<?php

namespace App\Controller;

use Fig\Http\Message\StatusCodeInterface;
use Slim\Http\Response;

class AbstractController
{
    public function sendErrorResponse(string $error, Response $response): Response
    {
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR)
            ->write(json_encode(['status' => 'error', 'error' => $error]));
    }
    public function sendValidationResponse(array $errors, Response $response): Response
    {
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR)
            ->write(json_encode(['status' => 'validation-error', 'errors' => $errors]));
    }

    public function sendSuccessResponse(array $data, Response $response): Response
    {
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(StatusCodeInterface::STATUS_OK)
            ->write(json_encode(['status' => 'success', 'response' => $data]));
    }
}