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
     * Get the URL of image_1 for the category.
     *
     * @return string|null
     */
    public function generateImage1UrlAttribute(): ?string
    {
        return Storage::disk('categoriesImages')->url("$this->id/$this->image_1");
    }
        /**
     * Get the URL of image_2 for the category.
     *
     * @return string|null
     */
    public function generateImage2UrlAttribute(): ?string
    {
        return Storage::disk('categoriesImages')->url("$this->id/$this->image_2");
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