<?php

use App\Interfaces\CMS\TemplateFieldInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTemplateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_template_fields', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->string('type', TemplateFieldInterface::FIELD_TYPE_MAX_LENGTH);
            $table->string('name', TemplateFieldInterface::FIELD_NAME_MAX_LENGTH);
            $table->string('slug', TemplateFieldInterface::FIELD_SLUG_MAX_LENGTH);
            $table->text('description')->nullable()->default(null);
            $table->boolean('is_required')->default(false);
            $table->unsignedInteger('order');
            $table->json('settings')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            // Index Creation
            $table->foreign('template_id')
                ->references('id')
                ->on('cms_templates')
                ->onDelete('cascade');
            $table->index('type');
            $table->index('name');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_template_fields');
    }
}
