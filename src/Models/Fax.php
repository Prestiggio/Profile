<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Profile\Models\Traits\ContactTrait;

class Fax extends Model
{
    use ContactTrait;
    
    protected $table = "ry_profile_faxes";
    
    protected $visible = ["id", "indicatif", "number"];

    protected $appends = ["number"];
    
    //protected $with = ["indicatif"];
    
    public function contact() {
    	return $this->hasOne("\Ry\Profile\Models\Contact", "ry_profile_contact_id")->where("ry_profile_contact_type", "=", self::class);
    }
    
    public function indicatif() {
    	return $this->belongsTo("Ry\Profile\Models\Indicatif", "indicatif_id");
    }

    public function getNumberAttribute() {
        $formatted = trim($this->raw, "+");
        if(!preg_match("/^".$this->indicatif->code."/i", $formatted)) {
            $formatted = $this->indicatif->code . $this->raw;
        }
        return "+" . $formatted;
    }
}
