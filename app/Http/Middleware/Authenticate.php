<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthTokenNotFoundException;
use App\Exceptions\UserTypeNotFoundException;
use App\Services\AuthenticationServices\Auth;
use App\Services\AuthenticationServices\Drivers\BearerTokenDriver;
use App\Services\AuthenticationServices\Exceptions\FailedToGetTokenException;
use App\Services\AuthenticationServices\Exceptions\NotAuthorizedRequest;
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
        if (Auth::check($roles, new BearerTokenDriver())) {
            return $next($request);
        }

        throw new NotAuthorizedRequest();
    }
}
