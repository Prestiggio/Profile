<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Medias\Models\Traits\MediableTrait;
use Ry\Admin\Listeners\MailSender;
use Ry\Admin\Listeners\SmsSender;
use Ry\Admin\Listeners\MessengerSender;
use Ry\Admin\Models\Alert;

class NotificationTemplate extends Model
{
    use MediableTrait;
    
    const CHANNELS = [
        MailSender::class => 'e_mail',
        /*SmsSender::class => 'sms',
        MessengerSender::class => 'messenger'*/
    ];
    
    protected $table = "ry_profile_notification_templates";
    
    protected $with = ['medias'];
    
    protected $appends = ["archannels"];
    
    public function getArchannelsAttribute() {
        return json_decode($this->channels, true);
    }
    
    public function setArchannelsAttribute($ar) {
        $this->channels = json_encode($ar);
    }
    
    public function alerts() {
        return $this->belongsToMany(Alert::class, 'ry_profile_template_alerts', 'template_id', 'alert_id');
    }
}
