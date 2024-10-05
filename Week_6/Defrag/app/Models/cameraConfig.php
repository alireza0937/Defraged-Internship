<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cameraConfig extends Model
{
    protected $fillable = ["cameraName", "cameraIP", "description", "cameraCode"];
    public $timestamps = false;
    use HasFactory;

    public function groupConfig()
    {
        return $this->belongsTo(groupCamera::class);
    }
}
