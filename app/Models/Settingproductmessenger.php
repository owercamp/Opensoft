<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingproductmessenger extends Model
{
    protected $table = "settingproductsmessenger";
    protected $primaryKey = "pmId";
    protected $fillable = [
        'pmProduct','pmAvailability','pmDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
