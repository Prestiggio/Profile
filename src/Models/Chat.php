<?php

namespace Ry\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Ry\Profile\Models\Traits\ContactTrait;

class Chat extends Model
{
    use ContactTrait;
    
    protected $table = "ry_profile_chats";
}
