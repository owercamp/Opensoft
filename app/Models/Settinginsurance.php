<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settinginsurance extends Model
{
    protected $table = "settinginsurances";
    protected $primaryKey = "insId";
    protected $fillable = [
        'insName','insDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
