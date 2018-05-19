<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSchedule extends Model
{
    protected $table = "ry_profile_contact_schedules";
    
    //protected $with = ["contact"];
    
    public function contact() {
    	return $this->belongsTo("Ry\Profile\Models\Contact", "contact_id");
    }
}
