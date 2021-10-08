<?php

namespace App\Services\AuthenticationServices;

use App\Exceptions\AuthTokenNotFoundException;
use App\Exceptions\UserTypeNotFoundException;
use App\Models\AuthToken;
use App\Models\User;
use App\Services\AuthenticationServices\Drivers\TokenDriverInterface;
use App\Services\AuthenticationServices\Exceptions\FailedToGetTokenException;
use JetBrains\PhpStorm\ArrayShape;

class AuthenticationClient
{
    /**
     * Check authentication of user by role / roles.
     * If you do not mind specific role, you can pass '*' as $roles param.
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

        if (!$this->isUserHasRoles($authToken->user, $roles) && $roles[0] !== '*') {
            return false;
        }

        return $this->isTokenValid($authToken->user, $authToken, $tokenInfo['token_hash']);
    }

    /**
     * Check if user have access to his / her account.
     * Authorization algorithm check email verification and
     * user's status.
     *
     * If user has not got access, method return messages
     * about specific causes.
     *
     * @param User $user
     * @return array
     */
    #[ArrayShape([
        'result' => "bool",
        'messages' => "array"
    ])]
    public function isUserHasAccess(User $user): array
    {
        $messages = [];

        if (!$user->email_verified) {
            $messages[] = 'E-mail адрес не подтверждён!';
        }

        if (
            in_array($user->type_id, [User::$LEGAL_RECRUITER_TYPE_ID, User::$EMPLOYER_TYPE_ID]) &&
            $user->status_id === User::$NOT_VERIFIED_STATUS_ID
        ) {
            $messages[] = 'Пользователь не прошёл модерацию!';
        }

        return [
            'result' => empty($messages),
            'messages' => $messages
        ];
    }

    /**
     * Get current authenticated user.
     * If user is not authenticated, return Null.
     *
     * @param TokenDriverInterface $tokenDriver
     * @return User|null
     */
    public function getCurrentUser(TokenDriverInterface $tokenDriver): ?User
    {
        if (!$tokenInfo = $tokenDriver->getTokenInfo()) {
            return null;
        }

        /** @var AuthToken|null $authToken */
        if (!$authToken = AuthToken::with('user')->find((int)$tokenInfo['token_id'])) {
            return null;
        }

        return $authToken->user;
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