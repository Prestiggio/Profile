<?php
$factory->define(\Ry\Profile\Models\Email::class, function (Faker\Generator $faker) {
	return [
			"address" => $faker->email,
			
	];
});