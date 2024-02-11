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
        Schema::table('edu_courses', function (Blueprint $table) {
            $table->string('vat')->nullable()->after('discount_price');
            $table->string('price_vat')->nullable()->after('discount_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('edu_courses', function (Blueprint $table) {
            $table->dropColumn('vat');
            $table->dropColumn('price_vat');
        });
    }
};
