<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingmotorcycle extends Model
{
    protected $table = "settingmotorcycles";
    protected $primaryKey = "motId";
    protected $fillable = [
        'motTypology','motDisplacement','motTimes','motDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
