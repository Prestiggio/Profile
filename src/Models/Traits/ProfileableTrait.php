<?php
namespace Ry\Profile\Models\Traits;

trait ProfileableTrait
{
	public function profile() {
		return $this->hasOne("Ry\Profile\Models\Profile", "user_id");
	}
	
	public function notifications_deprecated() {
		return $this->hasMany("Ry\Profile\Models\Notification", "user_id");
	}
}