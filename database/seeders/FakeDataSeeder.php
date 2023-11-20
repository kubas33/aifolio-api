<?php

namespace Database\Seeders;

use App\Helpers\ImageHelper;
use App\Models\AiImage;
use App\Models\AiImageFilename;
use App\Models\AiImageMeta;
use App\Models\AiModel;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        AiModel::Factory(50)->create();
        Category::Factory(50)->create();

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
            $sizes_array = ['xxl' => 2160, 'lg' => 1080, 'md' => 720, 'sm' => 360];
            $image->user_id = fake()->numberBetween(1, 100);
            //$filename_wo_ext = "image_" . fake()->numberBetween(1, 100);
            $image->image_type = 'text2img';
            $image->category_id = fake()->numberBetween(1, 100);
            $image->ai_image_meta_id = $meta->id;
            $image->save(); //zapisanie aby wygenerowało się id 

            $filename_wo_ext = $image->id . "_" . Carbon::now()->timestamp;
            $image->original_file_name = $filename_wo_ext . ".png";
            $image->save();

            $this->saveRandomAiImage($image);
            foreach ($sizes_array as $size => $width) {
                $image_file = new AiImageFilename();
                $image_file->ai_image_id = $image->id;
                $image_file->filename = $size . "_" . $filename_wo_ext . ".webp";
                $image_file->img_width = $width;
                $image_file->img_height = $width;
                $image_file->save();
            }

            $tags = fake()->randomElements($tagsIds, fake()->numberBetween(1, 10));
            $image->tags()->sync($tags);
        }
    }

    function saveRandomAiImage(AiImage $image) {
        $aiImageDisk = Storage::disk('exampleImages');

        // Pobierz listę plików z folderu aiImages
        $aiImageFiles = $aiImageDisk->allFiles('aiImages');

        if (!empty($aiImageFiles)) {
            // Wylosuj losowy plik z folderu
            $randomAiImage = $aiImageFiles[array_rand($aiImageFiles)];

            // Wczytaj zawartość pliku
            $imageContent = $aiImageDisk->get($randomAiImage);

            if ($imageContent) {
                ImageHelper::saveAiImage($imageContent, $image->id, $image->original_file_name);
            } 
        } else {
            // Obsługa sytuacji, gdy tablica jest pusta
            throw new Exception('Brak plików w folderze aiImages.');
        }
    }
}
