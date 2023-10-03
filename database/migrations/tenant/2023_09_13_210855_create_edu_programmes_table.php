<?php

use App\Interfaces\EDU\Course\CourseInterface;
use App\Interfaces\EDU\Purchase\PurchaseInterface;
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

            // Image and Video
            $table->string('content_length_video')->nullable();
            $table->longText('banner')->nullable();
            $table->longText('primary_image')->nullable();
            $table->longText('video_preview')->nullable();

            // Price
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('currency')->nullable()->default(PurchaseInterface::CURRENCY_GB);

            // Webinars
            $table->boolean('has_webinars')->nullable()->default(false);

            // Features
            $table->string('languages')->nullable();
            $table->boolean('has_money_back_guarantee')->nullable()->default(true);
            $table->boolean('has_certificate')->nullable()->default(false);
            $table->boolean('has_captions')->nullable()->default(false);
            $table->boolean('has_lifetime_access')->nullable()->default(true);
            $table->boolean('has_student_discount')->nullable()->default(false);
            $table->boolean('has_pdfs')->nullable()->default(false);
//            $table->boolean('has_external_references')->nullable()->default(false); // TODO:: build the edu_course_external_references

            $table->boolean('has_free_seo_exposure')->nullable()->default(true); // Clients will get exposure on lecturer/business social channels

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
