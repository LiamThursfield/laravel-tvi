<?php

use App\Interfaces\Course\CourseInterface;
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
        Schema::create('edu_programmes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('creator_id')->index();
            $table->string('status')->default(CourseInterface::STATUS_DRAFT);
            $table->string('content_length_video')->nullable();
            $table->longText('banner')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_programmes');
    }
};
