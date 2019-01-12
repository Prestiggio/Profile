<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JoinableMorph extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_contacts', function (Blueprint $table) {
        	$table->dropForeign("ry_profile_contacts_user_id_foreign");
        	$table->dropUnique("contact_book_unique");
            $table->dropColumn("user_id");
            $table->morphs("joinable");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_contacts', function (Blueprint $table) {
            //
        });
    }
}
