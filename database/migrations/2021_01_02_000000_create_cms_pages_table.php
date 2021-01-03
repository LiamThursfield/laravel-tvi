<?php

use App\Interfaces\CMS\CMSInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('layout_id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name', CMSInterface::FIELD_NAME_MAX_LENGTH);
            $table->string('slug', CMSInterface::FIELD_NAME_MAX_LENGTH);
            $table->timestamp('enabled_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            // Index Creation
            $table->foreign('layout_id')
                ->references('id')
                ->on('cms_layouts')
                ->onDelete('cascade');
            $table->foreign('template_id')
                ->references('id')
                ->on('cms_templates')
                ->onDelete('cascade');
            $table->foreign('parent_id')
                ->references('id')
                ->on('cms_pages')
                ->onDelete('cascade');

            $table->index('name');
            $table->unique('slug');
            $table->index('enabled_at');
            $table->index('published_at');
            $table->index('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_pages');
    }
}
