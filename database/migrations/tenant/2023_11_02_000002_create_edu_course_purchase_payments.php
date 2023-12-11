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
        Schema::create('edu_course_purchase_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_purchase_id');
            $table->string('status'); // PENDING | PAID | REFUNDED | FAILED | NOT_DUE | OVERDUE
            $table->string('price');
            $table->string('currency')->default(CoursePurchaseInterface::CURRENCY_GB);
            $table->date('due_date');
            $table->dateTime('paid_at')->nullable();
            $table->string('payment_gateway_response_id')->nullable();
            $table->json('payment_gateway_response')->nullable();

            $table->timestamps();

            // Indexes
            $table->foreign('course_purchase_id')
                ->references('id')
                ->on('edu_courses');

            $table->index('status');
            $table->index('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_course_edu_course_payments');
    }
};
