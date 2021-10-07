<?php

namespace App\Services\AuthenticationServices\Exceptions;

use App\Exceptions\ApiBaseException;

class FailedToGetTokenException extends ApiBaseException
{
    protected string $defaultErrorMessage = 'Не удалось получить токен доступа.';

    protected int $httpStatusCode = 422;
}