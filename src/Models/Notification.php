<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
	use SoftDeletes;
	
    protected $table = "ry_profile_notifications";
    
    protected $dates = ['deleted_at'];
    
    public function object() {
    	return  $this->morphTo();
    }
}
