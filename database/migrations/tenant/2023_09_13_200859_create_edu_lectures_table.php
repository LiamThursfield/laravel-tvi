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
        Schema::create('edu_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->string('description')->index()->nullable();
            $table->boolean('can_be_previewed')->default(false);
            $table->longText('preview_url')->nullable();
            $table->longText('video_url')->nullable();
            $table->longText('content_length')->nullable();
            $table->longText('index')->nullable();
            $table->longText('item_type')->nullable(); // Lecture OR Quiz
            $table->unsignedBigInteger('section_id')->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_lectures');
    }
};
