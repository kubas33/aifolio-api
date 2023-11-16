<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTag
 */
class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function aiImages() : BelongsToMany {
        return $this->belongsToMany(AiImage::class);
    }
}
