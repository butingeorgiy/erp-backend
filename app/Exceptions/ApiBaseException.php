<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class ApiBaseException extends Exception
{
    protected int $httpStatusCode = 500;

    protected string $defaultErrorMessage = 'Happen API error!';


    /**
     * Return context of exception for logging.
     *
     * @return array
     */
    public function context(): array
    {
        return [];
    }

    /**
     * Report exception.
     *
     * @return bool
     */
    public function report(): bool
    {
        Log::channel('errorlog')->error(
            $this->getMessage() ?: $this->defaultErrorMessage,
            array_merge([
                'meta' => [
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]
            ], $this->context())
        );

        return false;
    }

    /**
     * Render exception.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage() ?: $this->defaultErrorMessage
        ], $this->httpStatusCode, options: JSON_UNESCAPED_UNICODE);
    }
}
