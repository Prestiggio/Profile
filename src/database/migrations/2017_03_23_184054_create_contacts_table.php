<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ry_profile_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id", false, true);
            $table->char("type")->nullable(); //domicile, bureau...
            $table->char("contact_type");
            $table->integer("contact_id", false, true);
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
        Schema::drop('ry_profile_contacts');
    }
}
