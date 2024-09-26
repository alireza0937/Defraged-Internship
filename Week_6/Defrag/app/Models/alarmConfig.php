<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alarmConfig extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'alarm_name',
        'group_id',
        'alarm_type_id',
        'object_id',
        'treshhold',
        'user_id',
        'subject',
        'description'
    ];

    
    use HasFactory;
}
