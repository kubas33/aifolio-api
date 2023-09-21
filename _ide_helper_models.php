<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AiImage
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_name
 * @property string $image_type
 * @property int $category_id
 * @property int $ai_image_meta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\AiImageMeta|null $meta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereAiImageMetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereImageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImage withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperAiImage {}
}

namespace App\Models{
/**
 * App\Models\AiImageMeta
 *
 * @property int $id
 * @property int|null $ai_model_id
 * @property string|null $ai_model_version
 * @property string|null $ai_model_hash
 * @property string|null $positive_prompts
 * @property string|null $negative_prompts
 * @property int|null $steps
 * @property string|null $sampler
 * @property string|null $cgf_scale
 * @property string|null $seed
 * @property string|null $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AiModel|null $aiModel
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereAiModelHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereAiModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereAiModelVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereCgfScale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereNegativePrompts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta wherePositivePrompts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereSampler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereSeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereSteps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AiImageMeta withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperAiImageMeta {}
}

namespace App\Models{
/**
 * App\Models\AiModel
 *
 * @property int $id
 * @property string $name
 * @property string|null $model_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AiImageMeta> $metas
 * @property-read int|null $metas_count
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel whereModelUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AiModel withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperAiModel {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AiImage> $aiImages
 * @property-read int|null $ai_images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperCategory {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperTag {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AiImage> $meta
 * @property-read int|null $meta_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

