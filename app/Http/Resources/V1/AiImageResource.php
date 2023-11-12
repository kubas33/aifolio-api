<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AiImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'fileName' => $this->file_name,
            'imageType' => $this->image_type,
            'categoryId' => $this->category_id,
            'aiImageMetaId' => $this->ai_image_meta_id,
            'aiImageMeta' => $this->meta ? new AiImageMetaResource($this->meta) : null,
            'imagePaths' => $this->getImagePaths(),
        ];
    }
}
