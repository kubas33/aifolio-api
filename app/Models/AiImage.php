<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the category that the AI image belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the meta information of the AI image.
     */
    public function meta()
    {
        return $this->belongsTo(AiImageMeta::class, 'ai_image_meta_id', 'id');
    }

    /**
     * Get the tags associated with the AI image.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
