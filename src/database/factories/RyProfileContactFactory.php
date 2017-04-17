<?php
use Ry\Profile\Models\Chat;
use Ry\Profile\Models\Phone;
use Ry\Profile\Models\Email;
$factory->define(\Ry\Profile\Models\Contact::class, function (Faker\Generator $faker) {
	
	$type = $faker->randomElement(['chat', 'email', 'phone']);
	switch ($type) {
		case "chat":
			$className = Chat::class;
			break;
			
		case "email":
			$className = Email::class;
			break;
			
		default:
		case "phone":
			$className = Phone::class;
			break;
			
	}
	
	$contact = factory($className, 1)->create();
	
	return [
			
			"user_id" => 0,
			
			"type" => $faker->randomElement(["domicile", "bureau", "vacance"]),
			
			"ry_profile_contact_type" => $className,
			
			"ry_profile_contact_id" => $contact->id,
			
	];
});