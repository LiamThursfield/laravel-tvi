<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_redirects', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->string('url_from');
            $table->string('url_to');
            $table->boolean('is_enabled')->default(false);
            $table->boolean('is_permanent')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            // Index Creation
            $table->index('is_enabled');
            $table->index('published_at');
            $table->index('expired_at');
            $table->unique('url_from', 'unique_url_from');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_redirects');
    }
}
