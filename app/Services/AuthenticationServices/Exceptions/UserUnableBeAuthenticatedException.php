<?php

namespace App\Services\AuthenticationServices\Exceptions;

use App\Exceptions\ApiBaseException;

class UserUnableBeAuthenticatedException extends ApiBaseException
{
    protected int $httpStatusCode = 403;

    protected string $defaultErrorMessage = 'Пользователь не может быть аутентифицирован.';
}