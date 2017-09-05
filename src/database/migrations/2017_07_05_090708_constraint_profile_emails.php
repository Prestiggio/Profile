<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintProfileEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_emails', function (Blueprint $table) {
            $table->unique("address");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_emails', function (Blueprint $table) {
        	$table->dropUnique("ry_profile_emails_address_unique");
        });
    }
}
