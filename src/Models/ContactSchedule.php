<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSchedule extends Model
{
    protected $table = "ry_profile_contact_schedules";
    
    public function contact() {
    	return $this->belongsTo("Contact", "contact_id");
    }
}
