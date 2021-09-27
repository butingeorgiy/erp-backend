<?php

namespace App\Exceptions;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class AuthTokenNotFoundException extends ApiBaseException
{
    protected static int $httpStatusCode = 404;

    protected static string $defaultErrorMessage = 'Не удалось найти токен по ID!';

    protected ?int $modelId;


    #[Pure]
    public function __construct(int $modelId = null)
    {
        $this->modelId = $modelId;

        parent::__construct();
    }

    #[ArrayShape(['model_id' => "int"])]
    public function context(): array
    {
        if ($this->modelId === null) {
            return [];
        }

        return [
            'model_id' => $this->modelId
        ];
    }
}