<?php

namespace App\Services\AuthenticateService;

use App\Exceptions\AuthTokenNotFoundException;
use App\Exceptions\UserTypeNotFoundException;
use App\Models\AuthToken;
use App\Models\User;
use App\Services\AuthenticateService\Drivers\TokenDriverInterface;
use App\Services\AuthenticateService\Exceptions\FailedToGetTokenException;

class AuthenticationClient
{
    /**
     * Check authentication of user by role / roles.
     *
     * @param string|array $roles List for roles that need check.
     * @param TokenDriverInterface $tokenDriver Token driver for token retrieving.
     * @return bool
     * @throws AuthTokenNotFoundException
     * @throws FailedToGetTokenException
     * @throws UserTypeNotFoundException
     */
    public function check(string|array $roles, TokenDriverInterface $tokenDriver): bool
    {
        if (!$tokenInfo = $tokenDriver->getTokenInfo()) {
            throw new FailedToGetTokenException();
        }

        if (gettype($roles) === 'string') {
            $roles = [$roles];
        }

        /** @var AuthToken|null $authToken */
        if (!$authToken = AuthToken::with('user')->find((int)$tokenInfo['token_id'])) {
            throw new AuthTokenNotFoundException((int)$tokenInfo['token_id']);
        }

        if (!$this->isUserHasRoles($authToken->user, $roles)) {
            return false;
        }

        return $this->isTokenValid($authToken->user, $authToken, $tokenInfo['token_hash']);
    }

    /**
     * Determine if user has specified roles.
     *
     * @param User $user
     * @param array $roles
     * @return bool
     * @throws UserTypeNotFoundException
     */
    protected function isUserHasRoles(User $user, array $roles): bool
    {
        if (!$userType = $user->type) {
            throw new UserTypeNotFoundException();
        }

        foreach ($userType->roles()->select('alias')->get() as $role) {
            if (in_array($role->alias, $roles)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if token valid.
     *
     * @param User $user
     * @param AuthToken $authToken
     * @param string $tokenHash
     * @return bool
     */
    protected function isTokenValid(User $user, AuthToken $authToken, string $tokenHash): bool
    {
        if (!$authToken->isValid()) {
            return false;
        }

        return $user->isHashValid($authToken, $tokenHash);
    }
}