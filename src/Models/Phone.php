<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Profile\Models\Traits\ContactTrait;

class Phone extends Model
{
    use ContactTrait;
    
    protected $table = "ry_profile_phones";
    
    protected $visible = ["id", "indicatif"];
    
    //protected $with = ["indicatif"];
    
    public function contact() {
    	return $this->hasOne("\Ry\Profile\Models\Contact", "ry_profile_contact_id")->where("ry_profile_contact_type", "=", self::class);
    }
    
    public function indicatif() {
    	return $this->belongsTo("Ry\Profile\Models\Indicatif", "indicatif_id");
    }
}
