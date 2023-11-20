<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperAiImage
 */
class AiImage extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the user that owns the AI image.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the category that the AI image belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the meta information of the AI image.
     */
    public function meta(): BelongsTo
    {
        return $this->belongsTo(AiImageMeta::class, 'ai_image_meta_id', 'id');
    }


    /**
     * Get the tags associated with the AI image.
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function aiImageFilenames(): HasMany
    {
        return $this->hasMany(AiImageFilename::class);
    }

    /**
     * Retrieves the paths of the images associated with the current object.
     *
     * @return array An array containing the paths of the images.
     */
    public function getImagePaths()
    {
    // Initialize variables
    $xxl = $lg = $md = $sm = $originalImage = null;

    // Get the filename without extension of the original image
        $originalImageWoExt = pathinfo($this->original_file_name, PATHINFO_FILENAME);

    // Get the resized image filenames
        $resizedImages = $this->aiImageFilenames;

    // Loop through the resized images
        foreach ($resizedImages as $resizedImage) {
        // Get the filename without extension of the resized image
            $resizedImageWoExt = pathinfo($resizedImage->filename, PATHINFO_FILENAME);

        // Get the disk URL of the resized image
            $diskUrl = Storage::disk('aiImages')->url($resizedImage->filename);

        // Assign the disk URL to the corresponding variable based on the resized image's filename
            switch ($resizedImageWoExt) {
                case 'xxl_' . $originalImageWoExt:
                    $xxl = $diskUrl;
                    break;
                case 'lg_' . $originalImageWoExt:
                    $lg = $diskUrl;
                    break;
                case 'md_' . $originalImageWoExt:
                    $md = $diskUrl;
                    break;
                case 'sm_' . $originalImageWoExt:
                    $sm = $diskUrl;
                    break;
            }
        }

    // Check if the original image exists and get its disk URL
        if ($this->original_file_name != null && Storage::disk('aiImages')->has("$this->original_file_name")) {
            $originalImage = Storage::disk('aiImages')->url($this->original_file_name);
        }

    // Return the image paths as an array
        return [
            'originalImage' => $originalImage,
            'xxl' => $xxl,
            'lg' => $lg,
            'md' => $md,
            'sm' => $sm
        ];
    }
}
