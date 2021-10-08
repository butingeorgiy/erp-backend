<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\AuthenticateRequest;
use App\Models\User;
use App\Services\AuthenticationServices\Auth;
use App\Services\AuthenticationServices\Drivers\BearerTokenDriver;
use App\Services\AuthenticationServices\Exceptions\FailedToAttachTokenException;
use App\Services\AuthenticationServices\Exceptions\UserUnableBeAuthenticatedException;
use App\Services\AuthenticationServices\Exceptions\UserWrongCredentialsException;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\ArrayShape;

class AuthenticationController extends Controller
{
    /**
     * Authenticate user by email and password.
     *
     * @param AuthenticateRequest $request
     * @return JsonResponse
     *
     * @throws FailedToAttachTokenException
     * @throws UserNotFoundException
     * @throws UserUnableBeAuthenticatedException
     * @throws UserWrongCredentialsException
     */
    #[ArrayShape([
        'success' => "bool",
        'credentials' => "array"
    ])]
    public function authenticate(AuthenticateRequest $request): JsonResponse
    {
        /** @var User|null $user */
        $user = User::byEmail($request->input('email'))->first()
            ?: throw new UserNotFoundException;

        $user->checkPassword($request->input('password'))
            ?: throw new UserWrongCredentialsException;

        # Check if user has got access to account.
        $isUserHasAccess = Auth::isUserHasAccess($user);

        if (!$isUserHasAccess['result']) {
            throw new UserUnableBeAuthenticatedException($isUserHasAccess['messages'][0]);
        }

        $authToken = $user->attachToken();

        return response()->json([
            'success' => true,
            'credentials' => [
                'token' => $authToken,
                'expired_at' => now(config('app.timezone'))->addDays(7)->format('Y-m-d H:i:s')
            ]
        ], options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Check user authentication status.
     *
     * @return JsonResponse
     */
    public function checkAuthenticationStatus(): JsonResponse
    {
        $response = [
            'is_auth' => false,
            'user_type_id' => null
        ];

        if ($user = Auth::getCurrentUser(new BearerTokenDriver)) {
            $response['is_auth'] = true;
            $response['user_type_id'] = $user->type_id;
        }

        return response()->json($response, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get data of current authenticated user.
     *
     * @return JsonResponse
     */
    public function getCurrentUser(): JsonResponse
    {
        $response = [
            'data' => null
        ];

        if ($user = Auth::getCurrentUser(new BearerTokenDriver)) {
            $data = $user->physicalRecruiterData;

            $response['data'] = [
                'first_name' => $data->first_name,
                'last_name' => $data->last_name
            ];
        }

        return response()->json($response, options: JSON_UNESCAPED_UNICODE);
    }
}
