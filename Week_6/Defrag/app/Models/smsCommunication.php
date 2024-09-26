<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class smsCommunication extends Model
{
    public $timestamps = false;
    protected $fillable = ["name", "auth_token", "communication_config_id"];
    use HasFactory;
}
