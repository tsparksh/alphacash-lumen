<?php

namespace App\Exceptions;

use Exception;

class NewsApiCallException extends Exception
{
    public function render($request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage()
        ]);
    }
}
