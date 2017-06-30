<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = "ry_profile_contacts";
	
	protected $visible = ["id", "type", "ry_profile_contact_type", "coord"];
	
	protected $appends = ["coord"];
	
    public function ry_profile_contact() {
		return $this->morphTo();
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
	
	public function owner() {
		return $this->belongsTo("App\User", "user_id");
	}
}
