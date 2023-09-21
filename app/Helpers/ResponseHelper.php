<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

abstract class ResponseHelper
{
    public static function response($data, $status): JsonResponse {
        return response()->json($data, $status);
    }
}
