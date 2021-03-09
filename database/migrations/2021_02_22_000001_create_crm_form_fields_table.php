<?php

use App\Interfaces\CRM\FormFieldInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_form_fields', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('type', FormFieldInterface::FIELD_TYPE_MAX_LENGTH);
            $table->string('name', FormFieldInterface::FIELD_NAME_MAX_LENGTH);
            $table->string('slug', FormFieldInterface::FIELD_SLUG_MAX_LENGTH);
            $table->boolean('is_required')->default(false);
            $table->unsignedInteger('order');
            $table->json('settings')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            // Index Creation
            $table->foreign('form_id')
                ->references('id')
                ->on('crm_forms')
                ->onDelete('cascade');
            $table->index('type');
            $table->index('name');
            $table->index('slug');
            $table->unique(['form_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_form_fields');
    }
}
