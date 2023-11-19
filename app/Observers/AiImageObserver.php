<?php

namespace App\Observers;

use App\Models\AiImage;

class AiImageObserver
{

    /**
     * Handle the AiImage "deleted" event.
     */
    public function deleted(AiImage $aiImage): void
    {
        foreach ($aiImage->aiImageFilenames as $imageFilename) {
            $imageFilename->delete();
        }
    }
}
