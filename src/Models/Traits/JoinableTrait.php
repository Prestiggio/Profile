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
		$type_labels = [
		    "phone" => __("Tél"),
		    "fax" => __("Fax"),
		    "email" => __("Email")
		];
		foreach ($this->contacts as $contact) {
			$s[] = $type_labels[$contact->ndetail['type']] . ': ' . $contact->ndetail['value'];
		}
		return implode("<br/>", $s);
	}
	
	public function isJoinable() {
		return $this->contacts->count() > 0;
	}
	
	protected function getArrayableRelations() {
	    $ar = $this->getArrayableItems($this->relations);
	    if(isset($ar['contacts'])) {
	        $ar['contacts'] = $ar['contacts']->keyBy(function($item){
	            return $item['ndetail']['schedule'].'_'.$item['ndetail']['type'];
	        });
	    }
	    return $ar;
	}
}