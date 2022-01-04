<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryInfoMultiLangToAdminCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_categories', function (Blueprint $table) {
            $table->string('cat_name_ch');
            $table->string('cat_name_ko');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_categories', function (Blueprint $table) {
            $table->dropColumn('cat_name_ch');
            $table->dropColumn('cat_name_ko');
        });
    }
}
