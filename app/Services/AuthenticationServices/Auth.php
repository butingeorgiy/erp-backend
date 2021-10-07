<?php

namespace App\Services\AuthenticationServices;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin AuthenticationClient
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AuthenticationClient::class;
    }
}