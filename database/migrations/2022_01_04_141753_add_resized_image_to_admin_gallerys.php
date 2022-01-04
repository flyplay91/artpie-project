<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResizedImageToAdminGallerys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_gallerys', function (Blueprint $table) {
            $table->string('resized_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_gallerys', function (Blueprint $table) {
            Schema::dropIfExists('resized_image');
        });
    }
}
