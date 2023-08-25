<?php

namespace App\Traits;

trait ResponseProvider
{
    public function sendResponse($payload, $statusCode = 200, $message = 'Berhasil', $meta = null, $metaData = null)
    {


        $Response = response()->json([
            'status' => true,
            'statusCode' => $statusCode,
            'message' => $message,
            'payload' => $payload,
        ], $statusCode);

        if ($meta && $metaData) {
            $Response = response()->json([
                'status' => true,
                'statusCode' => $statusCode,
                'message' => $message,
                'payload' => $payload,
                $meta => $metaData
            ], $statusCode);
        }

        return $Response;
    }

    public function sendResponseWithPagination($payload, $statusCode, $message = "Berhasil")
    {
        $data = $payload->items();
        $metaData = [
            'current_page' => $payload->currentPage(),
            'last_page' => $payload->lastPage(),
            'from' => $payload->firstItem(),
            'to' => $payload->lastItem(),
            'per_page' => $payload->perPage(),
            'total_data' => $payload->total(),
            'show' => $payload->count(),
        ];

        return $this->sendResponse($data, $statusCode, $message, 'meta', $metaData);
    }


    public function sendError($errorCode = 400, $errorMessage = 'Error', $trace = [])
    {
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') {
            return response()->json([
                'status' => false,
                'statusCode' => $errorCode,
                'message' => $errorMessage,
                'env_mode' => env('APP_ENV'),
                'trace' =>  $trace,
            ], $errorCode);
        }
        return  response()->json([
            'status' => false,
            'statusCode' => $errorCode,
            'message' => $errorMessage
        ], $errorCode);
    }
}
