<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_metadata', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('metadatable_id');
            $table->string('metadatable_type');
            $table->string('canonical')->nullable();
            $table->string('description')->nullable();
            $table->string('title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();;
            $table->timestamps();

            // Index Creation
            $table->index('metadatable_id');
            $table->index('metadatable_type');
            $table->unique(
                ['metadatable_id', 'metadatable_type'],
                'unique_metadatable_id'
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
        Schema::dropIfExists('cms_metadata');
    }
}
