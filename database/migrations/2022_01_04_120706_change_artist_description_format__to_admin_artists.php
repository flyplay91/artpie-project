<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeArtistDescriptionFormatToAdminArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_artists', function (Blueprint $table) {
            $table->text('art_description')->change();
            $table->text('art_description_ch')->change();
            $table->text('art_description_ko')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_artists', function (Blueprint $table) {
            $table->dropColumn('art_description');
            $table->dropColumn('art_description_ch');
            $table->dropColumn('art_description_ko');
        });
    }
}
