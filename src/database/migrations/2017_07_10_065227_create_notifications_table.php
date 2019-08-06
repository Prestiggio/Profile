<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ry_profile_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger("user_id");
            $table->json("setup");
            $table->integer("priority")->default(0);
            $table->timestamp("seen_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ry_profile_notifications');
    }
}
