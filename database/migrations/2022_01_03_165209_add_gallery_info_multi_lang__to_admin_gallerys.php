<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGalleryInfoMultiLangToAdminGallerys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_gallerys', function (Blueprint $table) {
            $table->string('title_ch')->nullable();
            $table->string('title_ko')->nullable();
            $table->string('description_ch')->nullable();
            $table->string('description_ko')->nullable();
            $table->string('artist_name_ch')->nullable();
            $table->string('artist_name_ko')->nullable();
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
            $table->dropColumn('title_ch');
            $table->dropColumn('title_ko');
            $table->dropColumn('description_ch');
            $table->dropColumn('description_ko');
            $table->dropColumn('artist_name_ch');
            $table->dropColumn('artist_name_ko');
        });
    }
}
