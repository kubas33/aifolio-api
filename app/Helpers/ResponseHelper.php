<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

abstract class ResponseHelper
{
    /**
     * Generate a JSON response.
     *
     * @param mixed $data
     * @param int $status
     * @return JsonResponse
     */
    public static function response($data, $status): JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * Generate a JSON response for paginated data.
     *
     * @param mixed $data
     * @param mixed $resourceClass
     * @param int $status
     * @return JsonResponse
     */
    public static function pageResponse($data, $resourceClass, $status): JsonResponse
    {
        return self::response([
            'data' => $resourceClass::collection($data->items()),
            'total' => $data->total(),
            'page' => $data->currentPage(),
            'lastPage' => $data->lastPage(),
            'perPage' => $data->perPage(),
        ], $status);
    }
}
