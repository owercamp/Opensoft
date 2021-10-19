<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingespecial extends Model
{
    protected $table = "settingespecials";
    protected $primaryKey = "espId";
    protected $fillable = [
        'espTypology','espPassengers','espDisplacement','espTransmission','espDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
