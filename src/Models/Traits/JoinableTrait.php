<?php
namespace Ry\Profile\Models\Traits;

trait JoinableTrait
{
    private $cacheContacts;
    
	public function contacts() {
		return $this->morphMany("Ry\Profile\Models\Contact", "joinable");
	}
	
	public function getNcontactsAttribute() {
	    if(!isset($this->cacheContacts)) {
	        $this->cacheContacts = $this->contacts;
	    }
	    $ar = [];
	    if($this->cacheContacts) {
	        foreach($this->cacheContacts as $contact) {
	            $ar[$contact->ndetail['type']][$contact->ndetail['schedule']] = $contact->ndetail['value'];
	        }
	    }
	    return $ar;
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