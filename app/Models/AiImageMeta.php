<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperAiImageMeta
 */
class AiImageMeta extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the AI model that owns the AI image meta.
     */
    public function aiModel(): BelongsTo
    {
        return $this->belongsTo(AiModel::class);
    }

    /**
     * Get the AI image associated with the AI image meta.
     */
    public function aiImage(): BelongsTo
    {
        return $this->belongsTo(AiImage::class);
    }
}
