<?php namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Admin\Models\Traits\HasJsonSetup;

class Emailconfirmation extends Model {
    
    use HasJsonSetup;

	protected $table = "ry_profile_emailconfirmations";
	
	public function user() {
		return $this->belongsTo("App\User", "user_id");
	}
	
	public function getDataAttribute() {
		return json_decode($this->session, true);
	}

}
