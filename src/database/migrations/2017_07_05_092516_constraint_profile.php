<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_profiles', function (Blueprint $table) {
        	$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        	$table->foreign("adresse_id")->references("id")->on("ry_geo_adresses");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_profiles', function (Blueprint $table) {
        	$table->dropForeign("ry_profile_profiles_user_id_foreign");
        	$table->dropIndex("ry_profile_profiles_user_id_foreign");
        	$table->dropForeign("ry_profile_profiles_adresse_id_foreign");
        	$table->dropIndex("ry_profile_profiles_adresse_id_foreign");
        });
    }
}
