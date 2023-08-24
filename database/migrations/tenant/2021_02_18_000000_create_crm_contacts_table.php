<?php

use App\Interfaces\CRM\ContactInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_contacts', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('telephone', ContactInterface::FIELD_TELEPHONE_MAX_LENGTH)->nullable();
            $table->string('email')->nullable();
            $table->boolean('marketing_email')->default(false);
            $table->boolean('marketing_sms')->default(false);
            $table->boolean('marketing_telephone')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // Index Creation
            $table->index('first_name');
            $table->index('last_name');
            $table->index('telephone');
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_contacts');
    }
}
