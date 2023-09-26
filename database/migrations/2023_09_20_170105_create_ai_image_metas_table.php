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
        Schema::create('ai_image_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ai_image_id')->nullable();
            $table->unsignedBigInteger('ai_model_id')->nullable();
            $table->string('ai_model_version')->nullable();
            $table->string('ai_model_hash')->nullable();
            $table->longText('positive_prompts')->nullable();;
            $table->longText('negative_prompts')->nullable();
            $table->integer('steps')->nullable();
            $table->string('sampler')->nullable();
            $table->decimal('cgf_scale')->nullable();
            $table->string('seed')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_image_metas');
    }
};
