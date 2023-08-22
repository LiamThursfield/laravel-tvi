<?php

use App\Interfaces\CRM\OrganisationUnitInterface;
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
        Schema::create('crm_organisation_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', OrganisationUnitInterface::TYPE_ENUM);
            $table->string('telephone', OrganisationUnitInterface::FIELD_TELEPHONE_MAX_LENGTH)->nullable();
            $table->string('email')->nullable();
            $table->json('socials')->nullable()->default(null);
            $table->json('notification_emails')->nullable()->default(null);

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();

            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('type');
            $table->index('telephone');
            $table->index('email');

            $table->foreign('parent_id')
                ->references('id')
                ->on('crm_organisation_units');

            $table->foreign('company_id')
                ->references('id')
                ->on('crm_organisation_units');

            $table->foreign('location_id')
                ->references('id')
                ->on('crm_organisation_units');

            $table->foreign('address_id')
                ->references('id')
                ->on('crm_addresses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_organisation_units');
    }
};
