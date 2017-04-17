<?php
$factory->define(\Ry\Profile\Models\Chat::class, function (Faker\Generator $faker) {
	return [
			
			"operateur" => $faker->randomElement(['orange', 'telma', 'airtel']),
			
			"username" => $faker->userName,
			
	];
});