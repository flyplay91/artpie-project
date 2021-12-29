<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryFragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_fragments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('gallery_id');
            $table->integer('piece_count');
            $table->float('buy_price');
            $table->float('sell_price');
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
        Schema::dropIfExists('gallery_fragments');
    }
}
