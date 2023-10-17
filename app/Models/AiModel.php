<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperAiModel
 */
class AiModel extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function metas() :HasMany
    {
        return $this->hasMany(AiImageMeta::class);
    }
}
