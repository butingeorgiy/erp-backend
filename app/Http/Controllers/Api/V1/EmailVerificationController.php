<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerificationRequest;
use App\Services\EmailVerificationService\EmailVerificationClient;
use App\Services\EmailVerificationService\Exceptions\NotFoundEmailVerificationException;
use Illuminate\Http\JsonResponse;

class EmailVerificationController extends Controller
{
    /**
     * Verify user's email.
     *
     * @param EmailVerificationRequest $request
     * @return JsonResponse
     *
     * @throws NotFoundEmailVerificationException
     */
    public function verify(EmailVerificationRequest $request): JsonResponse
    {
        $uuid = $request->input('uuid');
        $salt = $request->input('salt');

        EmailVerificationClient::verify($uuid, $salt);

        return response()->json([
            'success' => true
        ], JSON_UNESCAPED_UNICODE);
    }
}
