<?php

namespace App\Services\AuthenticateService\Drivers;

use JetBrains\PhpStorm\ArrayShape;

class UnitTestingTokenDriver implements TokenDriverInterface
{
    public function __construct(
        protected int $tokenId,
        protected string $tokenHash
    ) {}

    /**
     * @inheritDoc
     */
    #[ArrayShape([
        'token_id' => "int",
        'token_hash' => "string"
    ])] public function getTokenInfo(): array|null
    {
        return [
            'token_id' => $this->tokenId,
            'token_hash' => $this->tokenHash
        ];
    }
}