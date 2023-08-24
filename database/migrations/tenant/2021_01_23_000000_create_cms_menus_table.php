<?php

use App\Interfaces\CMS\CMSInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateCmsMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menus', function (Blueprint $table) {
            // Field Creation
            $table->id();
            $table->string('name', CMSInterface::FIELD_NAME_MAX_LENGTH);
            $table->string('slug', CMSInterface::FIELD_SLUG_MAX_LENGTH);
            $table->json('menu_items')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Index Creation
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
        Schema::dropIfExists('cms_menus');
    }
}
