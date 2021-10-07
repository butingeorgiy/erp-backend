<?php

namespace App\Services\AuthenticationServices\Exceptions;

use App\Exceptions\ApiBaseException;

class UserWrongCredentialsException extends ApiBaseException
{
    protected int $httpStatusCode = 403;

    protected string $defaultErrorMessage = 'Неверные данные для входа в аккаунт.';
}