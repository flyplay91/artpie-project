<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDescriptionFormatToAdminGallerys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_gallerys', function (Blueprint $table) {
            $table->text('description')->change();
            $table->text('description_ch')->change();
            $table->text('description_ko')->change();
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
            $table->dropColumn('description');
            $table->dropColumn('description_ch');
            $table->dropColumn('description_ko');
        });
    }
}
