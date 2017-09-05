<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfileIndicatifs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_indicatifs', function (Blueprint $table) {
        	$table->foreign("country_id")->references("id")->on("ry_geo_countries")->onDelete("cascade");
        	$table->unique("code");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_indicatifs', function (Blueprint $table) {
            $table->dropUnique("ry_profile_indicatifs_code_unique");
            $table->dropForeign("ry_profile_indicatifs_country_id_foreign");
            $table->dropIndex("ry_profile_indicatifs_country_id_foreign");
        });
    }
}
