<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToGalleryFragments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_fragments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('gallery_id')->change();
            $table->unsignedInteger('piece_count')->change();
            $table->foreign('gallery_id')->references('id')->on('admin_gallerys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_fragments', function (Blueprint $table) {
            $table->dropForeign('gallery_fragments_gallery_id_foreign');
        });
    }
}
