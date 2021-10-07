<?php

namespace App\Services\AuthenticationServices\Exceptions;

use App\Exceptions\ApiBaseException;

class NotAuthorizedRequest extends ApiBaseException
{
    protected int $httpStatusCode = 401;

    protected string $defaultErrorMessage = 'Пользователь не авторизован для данного действия.';
}