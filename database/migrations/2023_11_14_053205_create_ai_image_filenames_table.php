<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ai_image_filenames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_image_id')->constrained()->cascadeOnDelete();
            $table->string('filename');
            $table->smallInteger('img_width');
            $table->smallInteger('img_height');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_image_filenames');
    }
};
