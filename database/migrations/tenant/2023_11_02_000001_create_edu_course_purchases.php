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
        Schema::create('edu_course_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('status'); // PENDING | PAID | PARTIALLY_PAID | REFUNDED
            $table->string('type'); // FULL | INSTALMENT
            $table->unsignedBigInteger('instalment_plan_id')->nullable();
            $table->string('email_address')->nullable(); // Required to make a purchase
            $table->unsignedBigInteger('user_id')->nullable(); // Set once a purchase is redeemed by an account
            $table->dateTime('redeemed_at')->nullable(); // Set once a purchase is redeemed by an account
            $table->boolean('is_refundable')->default(true);
            $table->string('total_price_due');
            $table->string('currency')->default(CoursePurchaseInterface::CURRENCY_GB);
            $table->string('total_price_paid')->default(0);
            $table->dateTime('full_price_paid_at')->nullable(); // The date that the full/final payment is made
            $table->string('payment_gateway');

            $table->timestamps();

            // Indexes
            $table->foreign('course_id')
                ->references('id')
                ->on('edu_courses');

            $table->foreign('instalment_plan_id')
                ->references('id')
                ->on('edu_course_instalment_plans');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->index('status');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_course_edu_course_purchases');
    }
};
