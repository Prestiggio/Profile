<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = "ry_profile_contacts";
	
	protected $visible = ["id", "type", "contact_type", "coord", "contact"];
	
	protected $appends = ["coord", "contact_type", "contact"];
	
    public function ry_profile_contact() {
		return $this->morphTo();
	}
	
	public function schedules() {
		return $this->hasMany("Ry\Profile\Models\ContactSchedule", "contact_id");
	}
	
	public function getCoordAttribute() {
		if($this->ry_profile_contact) {
			if($this->ry_profile_contact_type == Chat::class)
				return $this->ry_profile_contact->username;
			
			if($this->ry_profile_contact_type == Email::class)
				return $this->ry_profile_contact->address;
			
			if ($this->ry_profile_contact_type == Phone::class)
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
		
		return "";
	}
	
	public function getContactAttribute() {
		return $this->ry_profile_contact;
	}
}
