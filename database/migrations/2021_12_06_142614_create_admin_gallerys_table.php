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
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('sign')->nullable();
            $table->string('frame')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('size')->nullable();
            $table->string('unit')->nullable();
            $table->float('actual_price')->nullable();
            $table->float('retail_price')->nullable();
            $table->string('check_enable_pieces')->nullable();
            $table->integer('piece_count')->nullable();
            $table->string('materials')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('safe_children')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('artist_id')->nullable();
            $table->string('paint_date')->nullable();
            $table->string('registered_date')->nullable();
            $table->string('updated_date')->nullable();
            $table->string('original')->nullable();
            $table->string('all_checked')->nullable();
            
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
