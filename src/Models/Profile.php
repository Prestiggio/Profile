<?php namespace Ry\Profile\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Ry\Geo\Models\Traits\Geoable;
use Ry\Admin\Models\Traits\HasJsonSetup;

class Profile extends Model {

	use Geoable, HasJsonSetup;
	
	protected $table = "ry_profile_profiles";
	
	//protected $with = ["adresse"];
	
	protected $fillable = ["gender", "firstname", "lastname", "official", "languages", "adresse_id", "setup"];
	
	protected $appends = ['nsetup', 'gender_label'];
	
	public function owner() {
		return $this->belongsTo(User::class, "user_id");
	}
	
	public function getGenderLabelAttribute() {
	    return __($this->gender);
	}
	
}
