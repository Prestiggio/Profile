<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Ry\Admin\Models\Traits\HasJsonSetup;

class Notification extends Model
{
	use HasJsonSetup;
	
    protected $table = "ry_profile_notifications";
    
    protected $appends = ['nsetup'];
    
    protected $hidden = ['setup'];

    public function getAgoAttribute() {
        Carbon::setLocale("fr");
        return $this->created_at->diffForHumans();
    }

    public function scopeUnseen($query) {
        $query->whereNull("seen_at"); 
    }
}
