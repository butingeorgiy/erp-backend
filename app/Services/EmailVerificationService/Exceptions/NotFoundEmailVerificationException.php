<?php

namespace App\Services\EmailVerificationService\Exceptions;

use App\Exceptions\ApiBaseException;

class NotFoundEmailVerificationException extends ApiBaseException
{
    protected int $httpStatusCode = 404;

    protected string $defaultErrorMessage = 'Запрос на верификацию не найден!';
}