<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthTokenNotFoundException;
use App\Exceptions\UserTypeNotFoundException;
use App\Services\AuthenticateService\Auth;
use App\Services\AuthenticateService\Drivers\CookieTokenDriver;
use App\Services\AuthenticateService\Exceptions\FailedToGetTokenException;
use App\Services\AuthenticateService\Exceptions\NotAuthorizedRequest;
use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string ...$roles
     * @return mixed
     *
     * @throws AuthTokenNotFoundException
     * @throws UserTypeNotFoundException
     * @throws FailedToGetTokenException
     * @throws NotAuthorizedRequest
     */
    public function handle(Request $request, Closure $next, ...$roles): mixed
    {
        if (Auth::check($roles, new CookieTokenDriver())) {
            return $next($request);
        }

        throw new NotAuthorizedRequest();
    }
}
