<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingservicemessenger extends Model
{
    protected $table = "settingservicesmessenger";
    protected $primaryKey = "smId";
    protected $fillable = [
        'smProduct_id','smService','smAvailability','smDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
