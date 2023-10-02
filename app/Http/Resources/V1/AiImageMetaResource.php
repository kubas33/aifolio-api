<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AiImageMetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'aiModelId' => $this->ai_model_id,
            'aiModelVersion' => $this->ai_model_version,
            'aiModelHash' => $this->ai_model_hash,
            'positivePrompts' => $this->positive_prompts,
            'negativePrompts' => $this->negative_prompts,
            'steps' => $this->steps,
            'sampler' => $this->sampler,
            'cgfScale' => $this->cgf_scale,
            'seed' => $this->seed,
            'size' => $this->size,
        ];
    }
}
