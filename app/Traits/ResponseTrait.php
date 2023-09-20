<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

trait ResponseTrait{

    public function successResponse(string $message = 'Request completed successfully', mixed $data = [], int $statusCode = 200) : Response {
        return response([
            'success' =>true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }


    public function errorResponse(string $message = 'Unable to process request', int $statusCode = 500) : Response {
        return response([
            'success' =>false,
            'message' => $message,
        ], $statusCode);
    }



    public function notFoundResponse()
    {
        return response([
            'success' => false,
            'message' => "Resource not found",
        ], 404);
    }

    public function invalidEndpointResponse()
    {
        return response([
            'success' => false,
            'message' => "Endpoint not found",
        ], 404);
    }
    public function invalidMethodResponse()
    {
        return response([
            'success' => false,
            'message' => "Invalid method for endpoint",
        ], 405);
    }
}
