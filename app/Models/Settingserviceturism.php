<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingserviceturism extends Model
{
    protected $table = "settingservicesturism";
    protected $primaryKey = "stId";
    protected $fillable = [
        'stProduct_id','stService','stAvailability','stDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
