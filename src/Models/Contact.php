<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function contact() {
		return $this->morphTo();
	}
}
