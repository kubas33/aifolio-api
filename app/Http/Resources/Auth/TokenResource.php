<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{

public function toArray(Request $request): array{
    return [
        'accessToken' => $this->accessToken,
        'expiresAt' => $this->token->expires_at,
        'updatedAt' => $this->token->updated_at,
        'revoked' => $this->token->revoked,
    ];}
}
