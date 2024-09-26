<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupCamera extends Model
{
    protected $fillable = ["group_config_id", "camera_config_id"];
    public $timestamps = false;
    use HasFactory;
}
