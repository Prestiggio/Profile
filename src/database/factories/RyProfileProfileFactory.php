<?php
use Ry\Geo\Models\Adresse;
$factory->define(Ry\Profile\Models\Profile::class, function (Faker\Generator $faker) {
	$majeur = new DateTime();
	$majeur->sub(new DateInterval("P18Y"));
	
	return [
			"user_id" => 0,
			
			"pseudo" => $faker->userName,
			
			"firstname" => $faker->firstName,
			
			"middlename" => $faker->firstName,
			
			"lastname" => $faker->lastName,
			
			"official" => $faker->name,
			
			"gender" => $faker->randomElement(['M', 'F']),
			
			"relationship" => $faker->randomElement(['célibataire', 'marié', 'divorcé', 'pacsé', 'compliqué']),
			
			"about" => $faker->text(50),
			
			"birthday" => $faker->date('Y-m-d', $majeur),
			
			"adresse_id" => Adresse::inRandomOrder()->first()->id,
			
			"languages" => $faker->languageCode
			
	];
});