<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificationObject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ry_profile_notifications', function (Blueprint $table) {
            $table->morphs("object");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ry_profile_notifications', function (Blueprint $table) {
            $table->dropColumn(["object_type", "object_id"]);
        });
    }
}
