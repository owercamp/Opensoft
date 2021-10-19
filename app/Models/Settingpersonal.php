<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingpersonal extends Model
{
    protected $table = "settingpersonals";
    protected $primaryKey = "perId";
    protected $fillable = [
        'perName','created_at','updated_at'
    ];
    public $timestamps = true;
}
