<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupConfig extends Model
{   public $timestamps = false;
    protected $fillable = ["name", "user_id"];
    use HasFactory;

    public function cameraConfig(){
        return $this->hasMany(cameraConfig::class);
    }
}
