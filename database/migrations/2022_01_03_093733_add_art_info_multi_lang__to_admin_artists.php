<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtInfoMultiLangToAdminArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_artists', function (Blueprint $table) {
            $table->string('art_name_ch');
            $table->string('art_description_ch');
            $table->string('art_name_ko');
            $table->string('art_description_ko');
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
            $table->dropColumn('art_name_ch');
            $table->dropColumn('art_description_ch');
            $table->dropColumn('art_name_ko');
            $table->dropColumn('art_description_ko');
        });
    }
}
