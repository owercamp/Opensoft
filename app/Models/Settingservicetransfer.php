<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingservicetransfer extends Model
{
    protected $table = "settingservicestransfer";
    protected $primaryKey = "strId";
    protected $fillable = [
        'strProduct_id','strService','strAvailability','strDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
