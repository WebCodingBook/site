<?php

namespace WebCoding;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_to', 'user_from', 'activity_id', 'type'];
}
