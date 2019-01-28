<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Medias\Models\Traits\MediableTrait;

class NotificationTemplate extends Model
{
    use MediableTrait;
    
    protected $table = "ry_profile_notification_templates";
    
    protected $with = ['medias'];
    
    protected $appends = ["archannels", "arevents", "arinjections"];
    
    protected $visible = ["id", "name", "archannels", "arevents", "arinjections", "medias"];
    
    public function getArinjectionsAttribute() {
        return json_decode($this->injections, true);
    }
    
    public function setArinjectionsAttribute($ar) {
        $this->injections = json_encode($ar);
    }
    
    public function getAreventsAttribute() {
        return json_decode($this->events, true);
    }
    
    public function setAreventsAttribute($ar) {
        $this->events = json_encode($ar);
    }
    
    public function getArchannelsAttribute() {
        return json_decode($this->channels, true);
    }
    
    public function setArchannelsAttribute($ar) {
        $this->channels = json_encode($ar);
    }
}
