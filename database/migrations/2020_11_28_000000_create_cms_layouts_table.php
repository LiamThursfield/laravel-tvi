<?php

use App\Interfaces\CMS\CMSInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_layouts', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->string('name', CMSInterface::FIELD_NAME_MAX_LENGTH);
            $table->string('slug', CMSInterface::FIELD_SLUG_MAX_LENGTH);
            $table->timestamps();
            $table->softDeletes();

            // Index Creation
            $table->foreign('template_id')
                ->references('id')
                ->on('cms_templates')
                ->onDelete('cascade');
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
        Schema::dropIfExists('cms_layouts');
    }
}
