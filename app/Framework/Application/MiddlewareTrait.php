<?php

namespace App\Framework\Application;

use App\Framework\Middleware\AuthMiddleware;
use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Fig\Http\Message\RequestMethodInterface;
use Fig\Http\Message\StatusCodeInterface;
use League\OpenAPIValidation\PSR15\SlimAdapter;
use League\OpenAPIValidation\PSR15\ValidationMiddlewareBuilder;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Exception\HttpException;
use Throwable;

trait MiddlewareTrait
{
    public static function addMiddlewares(App $app): void
    {
        self::addValidationMiddleware($app);
        self::addAuthMiddleware($app);
        self::addErrorMiddleware($app);
        self::addCorsMiddleware($app);
    }

    private static function addAuthMiddleware(App $app): void
    {
        $app->addMiddleware(new AuthMiddleware(
            $app->getContainer()->get(GetAuthorizedUserIdInterface::class)
        ));
    }

    private static function addValidationMiddleware(App $app): void
    {
        /*$yamlFileConfigPath = DIR_ROOT . '/app/Framework/OpenApi/api.yaml';

        $validationMiddlewareBuilder = new ValidationMiddlewareBuilder();
        $psr15Middleware = $validationMiddlewareBuilder->fromYamlFile($yamlFileConfigPath)->getValidationMiddleware();
        $slimMiddleware = new SlimAdapter($psr15Middleware);
        $app->add($slimMiddleware);*/
    }

    private static function addErrorMiddleware(App $app): void
    {
        $errorMiddleware = $app->addErrorMiddleware(true, true, true);
        $customErrorHandler = function (
            ServerRequestInterface $request,
            Throwable $exception
        ) use ($app) {
            $payload = [
                'status' => 'error'
            ];

            if ($exception instanceof HttpException) {
                $httpStatus = $exception->getCode();
                $payload['error'] = $exception->getMessage();
            } else {
                if (((int) $_SERVER['DEBUG_MODE'] ?? 0) === 1) {
                    $payload['error'] = $exception->getMessage();
                    $payload['trace'] = $exception->getTrace();
                } else {
                    $payload['error'] = 'Something went terribly wrong';
                }
                $httpStatus = StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR;
                $logger = $app->getContainer()->get(LoggerInterface::class);
                $logger->error($exception->getMessage());
            }

            if ($request->getMethod() === RequestMethodInterface::METHOD_OPTIONS) {
                $httpStatus = StatusCodeInterface::STATUS_OK;
            }

            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write(
                json_encode($payload, JSON_UNESCAPED_UNICODE)
            );

            return $response
                ->withStatus($httpStatus);
        };
        $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
    }

    private static function addCorsMiddleware(App $app): void
    {
        $app->options('/{routes:.+}', function ($request, $response) {
            return $response;
        });

        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, Access-Token')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        });
    }
}