<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Auth\TokenResource;


class AuthResource extends JsonResource
{

public function toArray(Request $request): array{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'email' => $this->email,
        'token' => $this->token != null ? new TokenResource($this->token) : null
    ];}
}
