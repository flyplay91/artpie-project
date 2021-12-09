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
            $table->string('sign');
            $table->string('frame');
            $table->string('width');
            $table->string('height');
            $table->string('unit');
            $table->string('actual_price');
            $table->string('retail_price');
            $table->string('check_enable_pieces');
            $table->string('piece_count');
            $table->string('materials');
            $table->string('description');
            $table->string('keywords');
            $table->string('safe_children');
            $table->string('category_id');
            $table->string('artist_id');
            $table->string('paint_date');
            $table->string('registered_date');
            $table->string('updated_date');
            $table->string('original');
            
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
