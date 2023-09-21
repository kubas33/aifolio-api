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



    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function meta() {
        return $this->hasOne(AiImageMeta::class, 'ai_image_meta_id', 'id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

}



