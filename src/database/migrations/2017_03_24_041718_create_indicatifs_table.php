<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ry_profile_indicatifs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("country_id", false, true);
            $table->char("code", 5);
            $table->char("format", 100);
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
        Schema::drop('ry_profile_indicatifs');
    }
}
