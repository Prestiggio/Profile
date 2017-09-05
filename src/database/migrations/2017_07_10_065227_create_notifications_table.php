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
            $table->integer("user_id", false, true);
            $table->text("presentation");
            $table->integer("priority")->default(0);
            $table->boolean("seen");
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
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
