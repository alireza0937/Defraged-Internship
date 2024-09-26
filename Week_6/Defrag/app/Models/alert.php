<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alert extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'camera_config_id',
        'object_config_id',
        'orgImageUrl',
        'imageUrl',
        'conf',
        'description'
    ];
    use HasFactory;
}
