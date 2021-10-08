<?php

namespace App\Services\AuthenticationServices\Drivers;

use JetBrains\PhpStorm\ArrayShape;
use Throwable;

class BearerTokenDriver implements TokenDriverInterface
{
    /**
     * @inheritDoc
     */
    #[ArrayShape([
        'token_id' => "int",
        'token_hash' => "string"
    ])] public function getTokenInfo(): array|null
    {
        if (!$token = request()->bearerToken()) {
            return null;
        }

        try {
            $token = decrypt($token, false);
        } catch (Throwable) {
            return null;
        }

        $splicedToken = explode('|', $token);

        if (count($splicedToken) !== 2) {
            return null;
        }

        return [
            'token_id' => $splicedToken[0],
            'token_hash' => $splicedToken[1]
        ];
    }
}