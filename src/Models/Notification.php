<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Notification extends Model
{
	use SoftDeletes;
	
    protected $table = "ry_profile_notifications";
    
    protected $dates = ['deleted_at', 'created_at'];
    
    public function object() {
    	return  $this->morphTo();
    }

    public function getAgoAttribute() {
        Carbon::setLocale("fr");
        return $this->created_at->diffForHumans();
    }

    public function scopeUnseen($query) {
        $query->where("seen", "=", 0); 
    }
}
