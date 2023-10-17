<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
