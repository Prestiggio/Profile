<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailconfirmationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ry_profile_emailconfirmations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedBigInteger("user_id")->nullable();
			$table->char("email");
			$table->char("hash");
			$table->boolean("valide");
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
		Schema::drop('ry_profile_emailconfirmations');
	}

}
