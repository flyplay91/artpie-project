<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminGallerysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_gallerys', function (Blueprint $table) {
            $table->id();
            $table->string('coll_id');
            $table->string('image');
            $table->string('title');
            $table->string('size');
            $table->string('price');
            $table->string('category');
            $table->string('artist_id');
            $table->string('pieces_number');
            $table->string('paint_date');
            $table->string('registered_date');
            $table->string('updated_date');
            $table->string('frame');
            $table->string('description');
            $table->string('keywords');
            $table->string('original');
            $table->string('signed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_gallerys');
    }
}
