<?php

use App\Interfaces\EDU\Course\CourseInterface;
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
        Schema::create('edu_webinars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->index();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('creator_id')->index();
            $table->unsignedBigInteger('course_id')->index();
            $table->unsignedBigInteger('section_id')->index()->nullable();
            $table->string('status')->default(CourseInterface::STATUS_DRAFT);

            // Schedule details
            $table->longText('date_time_from')->nullable();
            $table->longText('date_time_to')->nullable();
            $table->longText('webinar_url')->nullable();
            $table->boolean('can_users_reserve')->nullable();
            $table->boolean('is_recorded')->nullable();
            $table->longText('recording_url')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_webinars');
    }
};
