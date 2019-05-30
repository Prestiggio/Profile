<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ry_profile_profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedBigInteger("user_id");
			$table->char("pseudo")->nullable();
			$table->char("firstname")->nullable();
			$table->char("middlename")->nullable();
			$table->char("lastname");
			$table->char("official");
			$table->char("gender", 10)->nullable();
			$table->char("relationship")->nullable();
			$table->text("about")->nullable();
			$table->date("birthday")->nullable();
			$table->integer("adresse_id", false, true)->nullable();
			$table->char("languages");
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
		Schema::drop('ry_profile_profiles');
	}

}
