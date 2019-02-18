<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = "ry_profile_contacts";
	
	protected $visible = ["id", "ndetail"];
	
	protected $appends = ["ndetail"];
	
    public function ry_profile_contact() {
		return $this->morphTo();
	}
	
	public function schedule() {
		return $this->hasOne("Ry\Profile\Models\ContactSchedule", "contact_id");
	}
	
	public function getDetailsAttribute() {
    	return [
    	        "type" => $this->contact_type,
    	        "value" => $this->contact->raw,
    	        "schedule" => $this->type
    	    ];
	}
	
	public function getCoordAttribute() {
		if($this->ry_profile_contact) {
			if($this->ry_profile_contact_type == Chat::class)
				return $this->ry_profile_contact->username;
			
			if($this->ry_profile_contact_type == Email::class)
				return $this->ry_profile_contact->address;
			
			if ($this->ry_profile_contact_type == Phone::class)
				return $this->ry_profile_contact->raw;
			
			if($this->ry_profile_contact_type == Fax::class)
			    return $this->ry_profile_contact->raw;
		}
		
		return "undefined";
	}
	
	public function joinable() {
		return $this->morphTo();
	}
	
	public function getContactTypeAttribute(){
		if($this->ry_profile_contact_type == Chat::class)
			return "chat";
			
		if($this->ry_profile_contact_type == Email::class)
			return "email";
			
		if ($this->ry_profile_contact_type == Phone::class)
			return "phone";
		
		if ($this->ry_profile_contact_type == Fax::class)
		    return "fax";
		
		return "";
	}
	
	public function getContactAttribute() {
		if($this->contact_type=="phone")
			return $this->ry_profile_contact()->first();
		return $this->ry_profile_contact;
	}
	
	public function getNdetailAttribute() {
	    return json_decode($this->detail, true);
	}
	
	public function setNdetailAttribute($contact) {
	    $this->detail = $contact;
	}
}
