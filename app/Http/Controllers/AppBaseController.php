<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json([
            'success' => true,
            'data' => $result,
            'message' => $message,
        ]);
    }

    public function sendError($error, $code = 422)
    {
        return Response::json([
            'success' => false,
            'message' => $error,
        ], $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    public function sendData($data)
    {
        return Response::json($data, 200);
    }
}
