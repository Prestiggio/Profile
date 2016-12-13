<?php
namespace Ry\Profile\Models\Traits;

trait ProfileableTrait
{
	public function profile() {
		return $this->hasOne("Ry\Profile\Models\Profile", "user_id");
	}
}