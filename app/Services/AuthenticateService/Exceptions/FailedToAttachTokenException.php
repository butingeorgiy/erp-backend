<?php

namespace App\Services\AuthenticateService\Exceptions;

use App\Exceptions\ApiBaseException;
use App\Models\User;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class FailedToAttachTokenException extends ApiBaseException
{
    protected User $user;

    protected static string $defaultErrorMessage = 'Failed to attach authentication token to user!';

    #[Pure]
    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    #[ArrayShape(['user_id' => "int"])]
    public function context(): array
    {
        return [
            'user_id' => $this->user->id
        ];
    }
}