<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;


    /**
     * Retrieves the paths of the images associated with the current object.
     *
     * @return array An array containing the paths of the images.
     */
    public function getImagesPaths(): array
    {
        // Initialize variables for image paths
        $image1 = '';
        $image2 = '';

        // Check if image 1 exists and has a valid path
        if ($this->image_1 != null && Storage::disk('categoryImages')->has("$this->image_1")) {
            // Get the URL of image 1
            $image1 = Storage::disk('categoryImages')->url($this->image_1);
        }

        // Check if image 2 exists and has a valid path
        if ($this->image_2 != null && Storage::disk('categoryImages')->has("$this->image_2")) {
            // Get the URL of image 2
            $image2 = Storage::disk('categoryImages')->url($this->image_2);
        }

        // Return the array of image paths
        return [
            $image1,
            $image2
        ];
    }

    /**
     * Get the aiImages for the category.
     *
     * @return HasMany
     */
    public function aiImages(): HasMany
    {
        return $this->hasMany(AiImage::class);
    }
}
