<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfileConfirmations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_emailconfirmations', function (Blueprint $table) {
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->unique("email");
            $table->unique("hash");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_emailconfirmations', function (Blueprint $table) {
            $table->dropUnique("ry_profile_emailconfirmations_email_unique");
            $table->dropUnique("ry_profile_emailconfirmations_hash_unique");
            $table->dropForeign("ry_profile_emailconfirmations_user_id_foreign");
            $table->dropIndex("ry_profile_emailconfirmations_user_id_foreign");
        });
    }
}
