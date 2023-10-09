<?php

namespace Database\Seeders;

use App\Models\AiImage;
use App\Models\AiImageMeta;
use App\Models\AiModel;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Event\Code\Test;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Factory(100)->create();
        Tag::Factory(100)->create();
        AiModel::Factory(100)->create();
        Category::Factory(100)->create();

        $tagsIds = Tag::all()->pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            $meta = new AiImageMeta();
            $meta->ai_model_id = fake()->numberBetween(1, 100);
            $meta->ai_model_version = '0.0.1';
            $meta->ai_model_hash = Hash::make('test');
            $meta->positive_prompts = join(',', fake()->words(10));
            $meta->negative_prompts = join(',', fake()->words(10));
            $meta->steps = fake()->numberBetween(20, 200);
            $meta->sampler = 'Kerras';
            $meta->cgf_scale = fake()->numberBetween(1, 20);
            $meta->seed = fake()->randomNumber();
            $meta->size = '512x768';
            $meta->save();

            $image = new AiImage();
            $image->user_id = fake()->numberBetween(1, 100);
            $image->file_name = "image_" . fake()->numberBetween(1, 100) . ".png";
            $image->image_type = 'text2img';
            $image->category_id = fake()->numberBetween(1, 100);
            $image->ai_image_meta_id = $meta->id;
            $image->save();

            $tags = fake()->randomElements($tagsIds, fake()->numberBetween(1, 10));
            $image->tags()->sync($tags);
        }
    }
}
