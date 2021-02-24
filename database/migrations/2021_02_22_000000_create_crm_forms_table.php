<?php

use App\Interfaces\CRM\FormInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_forms', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->string('name', FormInterface::FIELD_NAME_MAX_LENGTH);
            $table->string('slug', FormInterface::FIELD_SLUG_MAX_LENGTH);
            $table->json('email_recipients')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index Creation
            $table->index('name');
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_forms');
    }
}