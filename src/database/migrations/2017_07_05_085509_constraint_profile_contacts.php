<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfileContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_contacts', function (Blueprint $table) {
        	$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        	$table->unique(["user_id", "ry_profile_contact_type", "ry_profile_contact_id"], "contact_book_unique");
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
        	$table->dropForeign("ry_profile_contacts_user_id_foreign");
            $table->dropUnique("contact_book_unique");
        });
    }
}
