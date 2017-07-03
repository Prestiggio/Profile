<?php namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Geo\Models\Traits\Geoable;

class Profile extends Model {

	use Geoable;
	
	protected $table = "ry_profile_profiles";
	
	protected $with = ["adresse"];
	
	protected $fillable = ["firstname", "lastname", "official", "languages", "adresse_id"];
	
	public function owner() {
		return $this->belongsTo("App\User", "user_id");
	}
	
}
