<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse($data, $message = 'success', $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }


    protected function errorResponse($message, $code = 500, $trace = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'trace' => $trace,
        ], $code);
    }
    
}
