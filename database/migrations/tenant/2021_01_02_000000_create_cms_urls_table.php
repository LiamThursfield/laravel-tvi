<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_urls', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->unsignedBigInteger('urlable_id');
            $table->string('urlable_type');
            $table->string('url_main');
            $table->string('url_full');
            $table->boolean('is_enabled')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            // Index Creation
            $table->index('urlable_id');
            $table->index('urlable_type');
            $table->unique('url_full');
            $table->index('is_enabled');
            $table->index('published_at');
            $table->index('expired_at');
            $table->unique(
                ['urlable_id', 'urlable_type'],
                'unique_urlable'
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
        Schema::dropIfExists('cms_urls');
    }
}
