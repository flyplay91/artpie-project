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
            $table->int('width');
            $table->int('height');
            $table->int('size');
            $table->string('unit');
            $table->float('actual_price');
            $table->float('retail_price');
            $table->string('check_enable_pieces');
            $table->int('piece_count');
            $table->string('materials');
            $table->string('description');
            $table->string('keywords');
            $table->string('safe_children');
            $table->int('category_id');
            $table->int('artist_id');
            $table->timestamps('paint_date');
            $table->timestamps('registered_date');
            $table->timestamps('updated_date');
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
