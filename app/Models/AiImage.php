<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    /**
     * Retrieves the paths of the images associated with the current object.
     *
     * @return array An array containing the paths of the images.
     */
    public function getImagePaths()
    {
        // Initialize variables for image paths
        $image = '';
        $originalImage = '';

        // Check if image 1 exists and has a valid path
        if ($this->file_name != null && Storage::disk('aiImages')->has("$this->file_name")) {
            // Get the URL of image 1
            $image = Storage::disk('aiImages')->url($this->file_name);
        }

        // Check if image 2 exists and has a valid path
        if ($this->original_file_name != null && Storage::disk('aiImages')->has("$this->original_file_name")) {
            // Get the URL of image 2
            $originalImage = Storage::disk('aiImages')->url($this->original_file_name);
        }

        // Return the array of image paths
        return [
            'image' => $image,
            'originalImage' => $originalImage
        ];
    }
}
