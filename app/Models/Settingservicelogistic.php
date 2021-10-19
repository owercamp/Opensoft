<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingservicelogistic extends Model
{
    protected $table = "settingserviceslogistic";
    protected $primaryKey = "slId";
    protected $fillable = [
        'slProduct_id','slService','slAvailability','slDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
