<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class ContactScheduleNotification extends Model
{
	protected $table = "ry_profile_contact_schedule_notifications";
	
	public function schedule() {
		return $this->belongsTo("ContactSchedule", "contact_schedule_id");
	}
	
	public function notification() {
		return $this->belongsTo("Notification", "notification_id");
	}
}
