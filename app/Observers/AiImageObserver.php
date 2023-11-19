<?php

namespace App\Observers;

use App\Models\AiImage;

class AiImageObserver
{
    /**
     * Handle the AiImage "created" event.
     */
    public function created(AiImage $aiImage): void
    {
        //TODO Czy dodać tutaj AiImageFilenamService->create  (zamiast wywoływania w AiImageService) ??
    }

    /**
     * Handle the AiImage "updated" event.
     */
    public function updated(AiImage $aiImage): void
    {
        //TODO Czy dodać tutaj AiImageFilenamService->update (zamiast wywoływania w AiImageService) ??
    }

    /**
     * Handle the AiImage "deleted" event.
     */
    public function deleted(AiImage $aiImage): void
    {
        foreach ($aiImage->aiImageFilenames as $imageFilename) {
            $imageFilename->delete();
        }
    }

    /**
     * Handle the AiImage "restored" event.
     */
    public function restored(AiImage $aiImage): void
    {
        //
    }

    /**
     * Handle the AiImage "force deleted" event.
     */
    public function forceDeleted(AiImage $aiImage): void
    {
        //
    }
}
