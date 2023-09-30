<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

abstract class ResponseHelper
{
    public static function response($data, $status): JsonResponse {
        return response()->json($data, $status);
    }

    public static function pageResponse($data, $resourceClass, $status): JsonResponse {
        return self::response([
            'data' => $resourceClass::collection($data->items()),
            'total' => $data->total(),
            'page' => $data->currentPage(),
            'lastPage' => $data->lastPage(),
            'perPage' => $data->perPage(),
        ], $status);
    }
}
