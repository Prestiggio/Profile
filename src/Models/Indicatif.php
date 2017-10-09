<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Indicatif extends Model
{
    protected $table = "ry_profile_indicatifs";
    
    protected $visible = ["id", "country", "code", "label"];
    
    protected $appends = ["label"];
    
    public function getLabelAttribute() {
    	return $this->country->nom . " (" . $this->code . ")";
    }
    
    public function country() {
    	return $this->belongsTo("\Ry\Geo\Models\Country", "country_id");
    }
}
