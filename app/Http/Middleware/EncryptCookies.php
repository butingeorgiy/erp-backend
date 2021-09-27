<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Symfony\Component\HttpFoundation\Response;

class EncryptCookies extends Middleware
{
    public function handle($request, Closure $next): Response
    {
        $this->except = [
            'auth_token'
        ];

        return parent::handle($request, $next);
    }
}
