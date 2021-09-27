<?php

namespace App\Services\AuthenticateService\Exceptions;

use App\Exceptions\ApiBaseException;

class FailedToGetTokenException extends ApiBaseException
{
    protected static string $defaultErrorMessage = 'Не удалось получить токен доступа!';

    protected static int $httpStatusCode = 422;
}