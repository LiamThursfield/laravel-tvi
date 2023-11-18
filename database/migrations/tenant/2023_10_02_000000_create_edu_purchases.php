<?php

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
        Schema::create('edu_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('payment_status');
            $table->boolean('is_refundable')->default(true);
            $table->string('email_address')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('redeemed_at')->nullable();
            $table->string('payment_currency')->default(PurchaseInterface::CURRENCY_GB);
            $table->string('payment_total');
            $table->string('payment_gateway')->nullable();
            $table->string('payment_gateway_response_id')->nullable();
            $table->json('payment_response')->nullable();

            $table->timestamps();

            // Indexes
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->index('email_address');
            $table->index('payment_status');
            $table->index('redeemed_at');
        });

        Schema::create('edu_purchase_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->string('purchasable_id');
            $table->string('purchasable_type');
            $table->integer('quantity')->default(1);
            $table->string('item_price');
            $table->string('total_price');

            $table->timestamps();

            // Indexes
            $table->foreign('purchase_id')
                ->references('id')
                ->on('edu_purchases')
                ->onDelete('cascade');

            $table->index(['purchasable_id', 'purchasable_type']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_purchases');
    }
};
