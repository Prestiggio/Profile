<?php
$factory->define(\Ry\Profile\Models\Phone::class, function (Faker\Generator $faker) {
	return [
			"indicatif_id" => 1,
			"operateur_id" => 1,
			"raw" => "031" . $faker->numberBetween(1111111, 9999999)			
	];
});