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
            $table->integer('coll_id');
            $table->string('image');
            $table->string('title');
            $table->string('sign');
            $table->string('frame');
            $table->integer('width');
            $table->integer('height');
            $table->integer('size');
            $table->string('unit');
            $table->float('actual_price');
            $table->float('retail_price');
            $table->string('check_enable_pieces');
            $table->integer('piece_count');
            $table->string('materials');
            $table->string('description');
            $table->string('keywords');
            $table->string('safe_children');
            $table->integer('category_id');
            $table->integer('artist_id');
            $table->string('paint_date');
            $table->string('registered_date');
            $table->string('updated_date');
            $table->string('original');
            $table->string('all_checked');
            
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
