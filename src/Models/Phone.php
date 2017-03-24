<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ry\Profile\Models\Traits\ContactTrait;

class Phone extends Model
{
    use ContactTrait;
    
    protected $table = "ry_profile_phones";
}
