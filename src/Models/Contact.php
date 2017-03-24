<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = "ry_profile_contacts";
	
    public function contact() {
		return $this->morphTo();
	}
}
