<?php
namespace Ry\Profile\Models\Traits;

trait JoinableTrait
{
	public function contacts() {
		return $this->hasMany("Ry\Profile\Models\Contact", "user_id");
	}
	
	public function getCompleteContactsAttribute() {
		$s = [];
		foreach ($this->contacts as $contact) {
			$s[] = $contact->ry_profile_contact;
		}
		return implode("<br/>", $s);
	}
}