<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settinglegalization extends Model
{
    protected $table = "settinglegalizations";
    protected $primaryKey = "legId";
    protected $fillable = [
        'legDocument','legDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
