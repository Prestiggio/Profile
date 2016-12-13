<?php namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Geo\Models\Traits\Geoable;

class Profile extends Model {

	use Geoable;
	
	public function owner() {
		return $this->belongsTo("App\User", "user_id");
	}

}
