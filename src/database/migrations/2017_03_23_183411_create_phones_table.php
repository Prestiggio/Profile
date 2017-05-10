<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ry_profile_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("indicatif_id", false, true);
            $table->integer("operateur_id", false, true);
            $table->char("raw", 100);
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
        Schema::drop('ry_profile_phones');
    }
}
