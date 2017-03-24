<?php namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Geo\Models\Traits\Geoable;
use Ry\Medias\Models\Traits\MediableTrait;

class Profile extends Model {

	use Geoable, MediableTrait;
	
	protected $table = "ry_profile_profiles";
	
	protected $with = ["adresse", "medias"];
	
	public function owner() {
		return $this->belongsTo("App\User", "user_id");
	}

}
