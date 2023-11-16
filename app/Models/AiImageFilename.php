<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperAiImageFilename
 */
class AiImageFilename extends Model
{
    use HasFactory, SoftDeletes;

    public function aiImage(): BelongsTo
    {
        return $this->belongsTo(AiImage::class);
    }
}
