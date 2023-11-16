<?php

namespace Database\Factories;

use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $image1Path = storage_path('app/exampleImages/categories/image1.jpg');
        $image2Path = storage_path('app/exampleImages/categories/image2.jpg');

        $numberOfWord = fake()->numberBetween(2, 3);
        $name = 'Category ' . fake()->unique()->words($numberOfWord, true);
        $slug = Str::slug($name);

        $fileName1 = "img_1_" . Carbon::now()->timestamp;
        $fileName2 = "img_2_" . Carbon::now()->timestamp;

        ImageHelper::saveCategoryImage(file_get_contents($image1Path), $slug, $fileName1);
        ImageHelper::saveCategoryImage(file_get_contents($image2Path), $slug, $fileName2);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image_1' => $fileName1,
            'image_2' => $fileName2,
        ];
    }
}
