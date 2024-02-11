<?php

use App\Interfaces\EDU\Course\CoursePurchaseInterface;
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
        Schema::create('edu_course_instalment_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedSmallInteger('instalment_count');
            $table->string('instalment_price');
            $table->string('instalment_discount_price')->nullable();
            $table->string('currency')->default(CoursePurchaseInterface::CURRENCY_GB);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->foreign('course_id')
                ->references('id')
                ->on('edu_courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_course_instalment_plans');
    }
};
