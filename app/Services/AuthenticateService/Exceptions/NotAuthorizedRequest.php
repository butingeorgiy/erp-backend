<?php

namespace App\Services\AuthenticateService\Exceptions;

use App\Exceptions\ApiBaseException;

class NotAuthorizedRequest extends ApiBaseException
{
    protected static int $httpStatusCode = 401;

    protected static string $defaultErrorMessage = 'Пользователь не авторизован для данного действия!';
}