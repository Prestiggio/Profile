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
            $table->text("presentation");
            $table->integer("priority")->default(0);
            $table->boolean("seen");
            $table->timestamps();
            $table->softDeletes();
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
