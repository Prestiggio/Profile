<?php
namespace Ry\Profile\Models\Traits;

trait JoinableTrait
{
	public function contacts() {
		return $this->hasMany("Ry\Profile\Models\Contact", "user_id");
	}
}