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
        Schema::create('ai_image_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('ai_image_id');
            $table->unsignedBigInteger('tag_id');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('ai_image_tag');
    }
};
