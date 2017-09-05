<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfileOperateurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_operateurs', function (Blueprint $table) {
        	$table->foreign("country_id")->references("id")->on("ry_geo_countries")->onDelete("cascade");
        	$table->unique(["code", "country_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_operateurs', function (Blueprint $table) {
            $table->dropUnique("ry_profile_operateurs_code_country_id_unique");
            $table->dropForeign("ry_profile_operateurs_country_id_foreign");
            $table->dropIndex("ry_profile_operateurs_country_id_foreign");
        });
    }
}
