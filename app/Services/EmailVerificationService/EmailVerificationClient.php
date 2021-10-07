<?php

namespace App\Services\EmailVerificationService;

use App\Models\EmailVerification;
use App\Models\User;
use App\Services\EmailVerificationService\Exceptions\NotFoundEmailVerificationException;
use Illuminate\Support\Str;

class EmailVerificationClient
{
    public function __construct(
        protected User $user
    ) {}

    /**
     * Generate email verification request.
     *
     * @return string
     */
    public function generateUrl(): string
    {
        $params = [
            'uuid' => $this->generateRequestUuid(),
            'salt' => Str::random()
        ];

        $this->user->emailVerification()->create($params);

        return route('verify-email', $params);
    }

    /**
     * Verify user by email verification request's uuid and salt.
     * If unable to verify user, exception will be thrown.
     *
     * @param string $uuid
     * @param string $salt
     *
     * @throws NotFoundEmailVerificationException
     */
    static function verify(string $uuid, string $salt): void
    {
        $model = EmailVerification::where([
            ['uuid', $uuid],
            ['salt', $salt]
        ])->first() ?: throw new NotFoundEmailVerificationException;

        # Switch user's email status on verified.
        $model->user->update(['email_verified' => 1]);
    }

    /**
     * Generate UUID for email verification request.
     *
     * @return string
     */
    protected function generateRequestUuid(): string
    {
        while (true) {
            $uuid = Str::uuid();

            if (EmailVerification::where('uuid', $uuid)->exists()) {
                continue;
            }

            break;
        }

        return $uuid;
    }
}