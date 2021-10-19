<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingpension extends Model
{
    protected $table = "settingpensions";
    protected $primaryKey = "penId";
    protected $fillable = [
        'penName','created_at','updated_at'
    ];
    public $timestamps = true;
}
