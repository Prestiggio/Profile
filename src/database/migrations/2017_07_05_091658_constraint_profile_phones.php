<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfilePhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_phones', function (Blueprint $table) {
        	$table->foreign("indicatif_id")->references("id")->on("ry_profile_indicatifs")->onDelete("cascade");
        	$table->foreign("operateur_id")->references("id")->on("ry_profile_operateurs")->onDelete("cascade");
        	$table->unique(["indicatif_id", "operateur_id", "raw"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_phones', function (Blueprint $table) {
        	$table->dropForeign("ry_profile_phones_indicatif_id_foreign");
        	$table->dropForeign("ry_profile_phones_operateur_id_foreign");
        	$table->dropIndex("ry_profile_phones_operateur_id_foreign");
            $table->dropUnique("ry_profile_phones_indicatif_id_operateur_id_raw_unique");
        });
    }
}
