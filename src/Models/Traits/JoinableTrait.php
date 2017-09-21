<?php
namespace Ry\Profile\Models\Traits;

trait JoinableTrait
{
	public function contacts() {
		return $this->morphMany("Ry\Profile\Models\Contact", "joinable");
	}
	
	public function getCompleteContactsAttribute() {
		$s = [];
		foreach ($this->contacts as $contact) {
			$s[] = $contact->ry_profile_contact;
		}
		return implode("<br/>", $s);
	}
	
	public function isJoinable() {
		return $this->contacts->count() > 0;
	}
}