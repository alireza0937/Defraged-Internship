<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class objectConfig extends Model
{
    protected $fillable = ["object_name", "object_code", "description"];
    public $timestamps = false;
    use HasFactory;
}
