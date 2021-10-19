<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingcourse extends Model
{
    protected $table = "settingcourses";
    protected $primaryKey = "couId";
    protected $fillable = [
        'couName','couIntensity','couDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
