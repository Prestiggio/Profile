<?php namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	public function owner() {
		return $this->belongsTo("App\User", "user_id");
	}

}
