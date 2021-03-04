<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_form_submissions', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->json('data')->nullable()->default(null);
            $table->timestamp('submitted_at')->useCurrent();

            // Index Creation
            $table->foreign('form_id')
                ->references('id')
                ->on('crm_forms');
            $table->foreign('contact_id')
                ->references('id')
                ->on('crm_contacts');
            $table->index('submitted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_form_submissions');
    }
}
