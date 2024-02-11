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
        Schema::create('edu_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('creator_id')->index();
            $table->string('status')->default(CourseInterface::STATUS_DRAFT);

            // Communication channel
            $table->boolean('platform')->nullable();
            $table->boolean('email')->nullable();
            $table->boolean('sms')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_announcements');
    }
};
