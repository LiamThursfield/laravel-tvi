<?php

use App\Interfaces\CMS\TemplateInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_templates', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->string('type', TemplateInterface::FIELD_TYPE_MAX_LENGTH);
            $table->string('name', TemplateInterface::FIELD_NAME_MAX_LENGTH);
            $table->string('slug', TemplateInterface::FIELD_SLUG_MAX_LENGTH);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index Creation
            $table->index('type');
            $table->index('name');
            $table->index('slug');
            $table->unique(['type', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_templates');
    }
}
