<?php

namespace App\Http\Resources\V1;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AiImageFilenameResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  Request  $request
   * @return array
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'aiImageId' => $this->ai_image_id,
      'filename' => $this->filename,
      'size' => $this->img_width . "x" . $this->img_height,
      'imgWidth' => $this->img_width,
      'imgHeight' => $this->img_height,
      'ratio' => $this->img_width / $this->img_height,
    ];
  }
}
