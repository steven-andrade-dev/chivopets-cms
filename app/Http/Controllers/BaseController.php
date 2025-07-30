<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Respuesta estándar de éxito
     *
     * @param  mixed $data
     * @param  string $message
     * @param  int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data, $message, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'msg' => $message,
            'items' => $data
        ], $statusCode);
    }

    /**
     * Respuesta estándar de error
     *
     * @param  string $message
     * @param  mixed $data
     * @param  int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($message, $data = [], $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'errorCode' => $errorCode,
            'msg' => $message,
            'data' => $data
        ], $statusCode);
    }
}
