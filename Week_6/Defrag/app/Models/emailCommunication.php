<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailCommunication extends Model
{
    public $timestamps = false;
    protected $fillable = ["name", "emailFrom", "smtpHost", "smtpUsername", "smtpPassword", "communication_config_id"];
    use HasFactory;
}
