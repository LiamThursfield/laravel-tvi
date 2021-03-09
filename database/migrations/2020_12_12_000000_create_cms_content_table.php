<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_content', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('contentable_id');
            $table->string('contentable_type');
            $table->unsignedBigInteger('template_field_id');
            $table->string('template_field_type');
            $table->longText('data')->nullable();
            $table->timestamps();

            // Index Creation
            $table->foreign('template_field_id')
                ->references('id')
                ->on('cms_template_fields')
                ->onDelete('cascade');
            $table->index('contentable_id');
            $table->index('contentable_type');
            $table->unique(
                ['contentable_id', 'contentable_type', 'template_field_id'],
                'unique_contentable_template_field'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_content');
    }
}
