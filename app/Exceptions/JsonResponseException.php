<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class JsonResponseException extends HttpResponseException
{

public function __construct($message, $status){$response = response()->json(['message' => $message], $status);

        parent::__construct($response);
    }
}
