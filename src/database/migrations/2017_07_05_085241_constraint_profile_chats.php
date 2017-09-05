<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfileChats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_chats', function (Blueprint $table) {
        	$table->unique(["operateur", "username"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_chats', function (Blueprint $table) {
            $table->dropUnique("ry_profile_chats_operateur_username_unique");
        });
    }
}
