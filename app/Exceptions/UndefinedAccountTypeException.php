<?php

namespace App\Exceptions;

class UndefinedAccountTypeException extends ApiBaseException
{
    protected string $defaultErrorMessage = 'Неизвестный тип пользователя!';
}