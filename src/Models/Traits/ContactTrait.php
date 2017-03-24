<?php
namespace Ry\Profile\Models\Traits;

trait ContactTrait
{
	public function owners() {
		return $this->morphMany("Ry\Profile\Models\Contact", "contact");
	}
}